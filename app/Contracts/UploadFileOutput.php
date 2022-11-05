<?php

namespace App\Contracts;

interface UploadFileOutput
{
    public function result(): bool;

    public function identifier(): string;
}
