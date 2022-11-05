<?php

namespace App\Traits;

trait DetectMimeType
{
    private function getBytesFromHexString(string $hexData): string
    {
        $bytes = [];

        for ($count = 0; $count < strlen($hexData); $count += 2)
        {
            $bytes[] = chr(hexdec(substr($hexData, $count, 2)));
        }

        return implode($bytes);
    }

    private function getMimeType(string $imageData): string | bool
    {
        $imageMimeTypes = array(
            "image/jpg" => "FFD8",
            "image/png" => "89504E470D0A1A0A",
            "image/gif" => "474946",
            "image/bmp" => "424D",
            "image/tiff" => "4949",
            "application/pdf" => "25504446",
            "docx"=> "504B0304",
            "doc" => "D0CF11E0A1",
            "xlsx"=> "504B030414000600",
            "xls" => "D0CF11E0A1B11AE1"
        );

        foreach ($imageMimeTypes as $mime => $hexBytes) {
            $bytes = $this->getBytesFromHexString($hexBytes);
            if (str_starts_with($imageData, $bytes)){
                return $mime;
            }
        }

        return false;
    }
}
