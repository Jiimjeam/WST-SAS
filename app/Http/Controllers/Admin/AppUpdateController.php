<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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

}
