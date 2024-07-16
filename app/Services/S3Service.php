<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use League\Flysystem\Visibility;
use Illuminate\Support\Facades\{App, Storage};

class S3Service
{
    /**
     * Create a file in s3 server.
     *
     * @param object $file
     * @param string $folder
     * @param string $visibility
     * @return string
     */
    public function create(object $file, string $folder, string $visibility = Visibility::PRIVATE): string
    {
        return Storage::put($folder, $file, $visibility);
    }

    /**
     * Check if file exists on storage.
     *
     * @param ?string $path
     * @return bool
     */
    public function exists(?string $path): bool
    {
        return $path ? Storage::exists($path) : false;
    }

    /**
     * Create a file in s3 with name.
     *
     * @param object $file
     * @param string $folder
     * @param string $name
     * @param string $visibility
     * @return string
     */
    public function createAs(
        object $file,
        string $folder,
        string $name,
        string $visibility = Visibility::PRIVATE,
    ): string {
        return Storage::putFileAs($folder, $file, $name, $visibility);
    }

    /**
     * Delete file from s3 server.
     *
     * @param string $path
     * @param string $visibility
     * @return void
     */
    public function delete(string $path): void
    {
        Storage::delete($path);
    }

    /**
     * Get a file s3 path.
     *
     * @param ?string $path
     * @return ?string
     */
    public function getPath(?string $path): ?string
    {
        if ($path) {
            if (App::environment(['testing', 'dusk']) || (env('ENVIRONMENT') && env('ENVIRONMENT') === 'dusk')) {
                return $path;
            }

            return Storage::temporaryUrl($path, Carbon::now()->addHours(2));
        }

        return null;
    }
}
