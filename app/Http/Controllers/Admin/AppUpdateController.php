<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Http;

class AppUpdateController extends Controller
{
    public function update(Request $request)
    {
        // 1. Define download path
        $updateUrl = 'https://github.com/Jiimjeam/WST-SAS/releases/download/v1.2.0-alpha/resources.zip';
        $zipPath = storage_path('app/resources.zip');
        $extractTo = base_path();

        try {
            Log::info("Attempting to download update from: $updateUrl");

            $response = Http::withHeaders([
                'User-Agent' => 'LaravelApp'
            ])->get($updateUrl);

            if (!$response->successful()) {
                Log::error("Failed to download the update from URL: $updateUrl - Status: " . $response->status());
                return response()->json(['success' => false, 'message' => 'Unable to download update.'], 500);
            }

            file_put_contents($zipPath, $response->body());
            Log::info("Update file downloaded and saved to: $zipPath");

            $zip = new ZipArchive;
            if ($zip->open($zipPath) === TRUE) {
                Log::info("Extracting files to: $extractTo");
                $zip->extractTo($extractTo);
                $zip->close();
                Log::info("Files successfully extracted.");

                File::delete($zipPath);
                Log::info("Update zip file deleted after extraction.");
            } else {
                Log::error("Failed to unzip the update file.");
                return response()->json(['success' => false, 'message' => 'Failed to unzip update.'], 500);
            }

            return response()->json(['success' => true, 'message' => 'Application updated.']);

        } catch (\Exception $e) {
            Log::error("Error during update: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred during the update.'], 500);
        }
    }



    public function checkForUpdate()
{
    $currentVersion = 'v1.1.0-alpha'; 

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('GITHUB_TOKEN'),
        'Accept' => 'application/vnd.github.v3+json'
    ])->get('https://api.github.com/repos/Jiimjeam/WST-SAS/releases/latest');

    if ($response->failed()) {
        return response()->json(['error' => 'Failed to fetch release info.'], 500);
    }

    $latest = $response->json();
    $latestVersion = $latest['tag_name'] ?? null;

    if (!$latestVersion) {
        return response()->json(['error' => 'No valid release found.'], 500);
    }

    return response()->json([
        'current_version' => $currentVersion,
        'latest_version' => $latestVersion,
        'has_update' => version_compare($latestVersion, $currentVersion, '>')
    ]);
}

}
