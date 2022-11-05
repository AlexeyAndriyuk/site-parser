<?php

namespace App\Services\Aws;

use Aws\S3\S3Client;

class AwsService
{
    protected S3Client $s3;

    protected string $bucket;

    public function __construct()
    {
        $this->bucket = config('filesystems.disks.s3.bucket');

        $this->s3 = S3Client::factory(
            [
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
                'version' => 'latest',
                'region' => config('filesystems.disks.s3.region'),
            ]
        );
    }
}
