<?php

namespace Tests\Unit\Infrastructure\UploaderImpl\Local;

use App\Infrastructure\UploaderImpl\Local\ImageUploaderImpl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploaderImplTest extends TestCase
{
    use RefreshDatabase;

    public function testUploadImage()
    {
        Storage::fake('design');

        $imageUploader = new ImageUploaderImpl();

        $uploadedFile = UploadedFile::fake()->image('design.png');

        $path = $imageUploader->upload($uploadedFile, 'test');
        Storage::disk('design')->assertMissing($uploadedFile->getFilename());

        // 実際に、app/public/test にファイルが入っていることを確認
        Storage::disk('local')->assertExists($path);
    }
}
