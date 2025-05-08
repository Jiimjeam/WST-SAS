<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use ZipArchive;


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
            return response()->json(['error' => 'Failed to fetch release.'], 500);
        }
    
        $release = $response->json();
        $assets = $release['assets'] ?? [];
    
        if (empty($assets)) {
            return response()->json(['error' => 'No downloadable assets in this release.'], 404);
        }
    
        // Download the update ZIP
        $downloadUrl = $assets[0]['browser_download_url'];
        $zipDir = storage_path('app');
        $zipFilePath = $zipDir . "/update-{$version}.zip";
    
        // Ensure the directory exists
        if (!File::exists($zipDir)) {
            File::makeDirectory($zipDir, 0755, true);
        }
    
        $download = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GITHUB_TOKEN')
        ])->get($downloadUrl);
    
        if ($download->failed()) {
            return response()->json(['error' => 'Failed to download update file.'], 500);
        }
    
        file_put_contents($zipFilePath, $download->body());
    
        // === AUTO-APPLY UPDATE ===
        try {
            $extractPath = storage_path("app/update-temp-{$version}");
    
            // Ensure extract path exists
            if (!File::exists($extractPath)) {
                File::makeDirectory($extractPath, 0755, true);
            }
    
            $zip = new ZipArchive;
            if ($zip->open($zipFilePath) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
            } else {
                return response()->json(['error' => 'Failed to unzip the update file.'], 500);
            }
    
            $basePath = base_path();
            $files = File::allFiles($extractPath);
    
            foreach ($files as $file) {
                $relativePath = str_replace($extractPath, '', $file->getPathname());
                $targetPath = $basePath . $relativePath;
    
                $targetDir = dirname($targetPath);
                if (!File::exists($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }
    
                File::copy($file->getPathname(), $targetPath);
            }
    
            // Clear Laravel caches
            Artisan::call('config:clear');
            Artisan::call('view:clear');
    
            return response()->json(['message' => "Update $version applied successfully."]);
        } catch (\Exception $e) {
            \Log::error('Update failed: ' . $e->getMessage());
            return response()->json(['error' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }








        public function checkForUpdate()
    {
        $versionFilePath = base_path('version.txt');

        if (!file_exists($versionFilePath)) {
            return response()->json(['error' => 'Version file not found.'], 500);
        }

        $currentVersion = trim(file_get_contents($versionFilePath));

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
