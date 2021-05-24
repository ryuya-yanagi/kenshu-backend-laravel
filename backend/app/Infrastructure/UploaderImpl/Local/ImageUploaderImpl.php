<?php

namespace App\Infrastructure\UploaderImpl\Local;

use App\Domains\Uploaders\ImageUploader;
use Illuminate\Http\UploadedFile;

class ImageUploaderImpl implements ImageUploader
{
    public function upload(UploadedFile $file, string $dir): string
    {
        $ext = $file->guessExtension();
        $pathname = $file->getPathName();
        $filename = $dir . '/' . hash_file('md5', $pathname) . '.' . $ext;
        $path = $file->storeAs('photos', $filename);
        return '/' . $path;
    }
}
