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
    public function performUpdate(Request $request)
    {
        $version = $request->input('version');
    
        if (!$version) {
            return response()->json(['error' => 'No version specified.'], 400);
        }
    
        // Fetch the release from GitHub
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GITHUB_TOKEN'),
            'Accept' => 'application/vnd.github.v3+json'
        ])->get("https://api.github.com/repos/Jiimjeam/WST-SAS/releases/tags/$version");
    
        if ($response->failed()) {
            Log::error("GitHub API fetch failed for version $version");
            return response()->json(['error' => 'Failed to fetch release.'], 500);
        }
    
        $release = $response->json();
        $assets = $release['assets'] ?? [];
    
        if (empty($assets)) {
            Log::warning("No assets found in GitHub release $version");
            return response()->json(['error' => 'No downloadable assets in this release.'], 404);
        }
    
        $downloadUrl = $assets[0]['browser_download_url'];
    
        
        $tenantUpdatePath = storage_path("tenant2/app");
        if (!File::exists($tenantUpdatePath)) {
            File::makeDirectory($tenantUpdatePath, 0755, true);
        }
    
        $zipFilePath = $tenantUpdatePath . "/update-{$version}.zip";
    
        // Download the file
        $download = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GITHUB_TOKEN')
        ])->get($downloadUrl);
    
        if ($download->failed()) {
            Log::error("Failed to download update file from $downloadUrl");
            return response()->json(['error' => 'Failed to download update file.'], 500);
        }
    
        try {
            file_put_contents($zipFilePath, $download->body());
        } catch (\Exception $e) {
            Log::error("Error writing ZIP file: " . $e->getMessage());
            return response()->json(['error' => 'Failed to save the update file.'], 500);
        }
    
        return response()->json([
            'message' => "Update $version downloaded successfully.",
            'file' => basename($zipFilePath)
        ]);
    }



    public function checkForUpdate()
{
    $currentVersion = 'v1.1.0-alpha';

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('GITHUB_TOKEN'),
        'Accept' => 'application/vnd.github.v3+json'
    ])->get('https://api.github.com/repos/Jiimjeam/WST-SAS/releases');

    if ($response->failed()) {
        return response()->json(['error' => 'Failed to fetch release info.'], 500);
    }

    $releases = collect($response->json())
        ->filter(fn($release) => isset($release['tag_name']) && $release['tag_name'] !== $currentVersion)
        ->map(fn($release) => [
            'version' => $release['tag_name'],
            'name' => $release['name'] ?? $release['tag_name'],
            'published_at' => $release['published_at'],
            'body' => $release['body'] ?? '',
        ])
        ->values();

    return response()->json([
        'current_version' => $currentVersion,
        'available_updates' => $releases,
        'has_update' => $releases->isNotEmpty(),
    ]);
}
}
