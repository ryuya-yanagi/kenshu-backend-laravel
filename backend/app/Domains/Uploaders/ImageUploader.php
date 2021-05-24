<?php

namespace App\Domains\Uploaders;

use Illuminate\Http\UploadedFile;

interface ImageUploader
{
    public function upload(UploadedFile $file, string $dir): string;
}
