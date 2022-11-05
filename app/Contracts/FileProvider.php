<?php

namespace App\Contracts;

interface FileProvider
{
    public function store(string $file, string $identifier): UploadFileOutput;

    public function get(string $identifier, string $lifetime): string;
}
