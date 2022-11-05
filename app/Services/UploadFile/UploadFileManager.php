<?php

namespace App\Services\UploadFile;

use App\Contracts\FileProvider;
use App\Contracts\UploadFileOutput;
use function uniqueHash;

class UploadFileManager
{
    public function __construct(
        private FileProvider $provider,
        private string $file
    ) {}

    public static function viaUrl(FileProvider $fileProvider, string $imageUrl): self
    {
        $file = @file_get_contents($imageUrl);

        return new static($fileProvider, $file);
    }

    public static function viaBase64(FileProvider $fileProvider, string $image): self
    {
        return new static ($fileProvider, $image);
    }

    public function upload(): UploadFileOutput
    {
        return $this->provider->store($this->file, uniqueHash());
    }
}
