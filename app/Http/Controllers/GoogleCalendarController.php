<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Illuminate\Support\Facades\Session;

use Laravel\Socialite\Facades\Socialite;

class GoogleCalendarController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.callback'));
        $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

        return redirect($client->createAuthUrl());
    }

    public function handleGoogleCallback()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(route('google.callback'));

        $client->fetchAccessTokenWithAuthCode(request('code'));
        Session::put('google_token', $client->getAccessToken());

        return redirect()->route('tenant.admin.calendar');
    }

    public static function getCalendarEvents()
    {
        $client = new Google_Client();
        $client->setAccessToken(Session::get('google_token'));

        if ($client->isAccessTokenExpired()) {
            Session::forget('google_token');
            return [];
        }

        $service = new Google_Service_Calendar($client);
        $calendarId = 'primary';

        $events = $service->events->listEvents($calendarId, [
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        ]);

        return $events->getItems();
    }

}
