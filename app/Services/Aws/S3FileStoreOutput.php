<?php

namespace App\Services\Aws;

use App\Contracts\UploadFileOutput;

class S3FileStoreOutput implements UploadFileOutput
{
    public function __construct(
        private bool $result,
        private string $identifier
    ) {}

    public function result(): bool
    {
        return $this->result;
    }

    public function identifier(): string
    {
        return $this->identifier;
    }
}
