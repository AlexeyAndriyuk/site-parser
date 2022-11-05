<?php

namespace App\Services\Aws;

use App\Contracts\FileProvider;
use App\Contracts\UploadFileOutput;
use App\Traits\DetectMimeType;

class S3FileManager extends AwsService implements FileProvider
{
    use DetectMimeType;

    public function store(string $file, string $identifier): UploadFileOutput
    {
        try {
            $this->s3->putObject([
                'Bucket' => $this->bucket,
                'Key' => $identifier,
                'SourceFile' => $file,
                'ContentType' => $this->getMimeType($file),
            ]);

            return new S3FileStoreOutput(true, $identifier);
        }
        catch (\Exception $e) {
            return new S3FileStoreOutput(false, $identifier);
        }
    }

    public function get(string $identifier, string $lifetime = '+20 minutes'): string
    {
        $cmd = $this->s3->getCommand('GetObject', [
            'Bucket' => $this->bucket,
            'Key' => $identifier,
        ]);

        return (string) $this->s3->createPresignedRequest($cmd, $lifetime)->getUri();
    }
}
