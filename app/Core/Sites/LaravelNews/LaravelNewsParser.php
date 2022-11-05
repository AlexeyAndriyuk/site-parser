<?php

namespace App\Core\Sites\LaravelNews;

use App\Core\Parse\BaseSiteParser;
use Carbon\Carbon;

class LaravelNewsParser extends BaseSiteParser
{
    public function title(): string
    {
        return trim($this->dom->find("h1", 0)->plaintext ?? 'Untitled');
    }

    public function description()
    {
        return trim($this->dom->find('.prose-sm.prose', 0)->innerText() ?? null);
    }

    public function image(): string | null
    {
        $image = $this->dom->find('main header picture img', 0)->src ?? null;

        if ($image && str_contains($image, ';base64,')) {
            $array = explode(';base64,', $image);
            return end($array);
        }

        return null;
    }

    public function publishedAt(): Carbon
    {
        $date = $this->dom->find('.text-xxs.font-mono.leading-none.text-white', 0)->plaintext;

        return Carbon::createFromFormat('F jS, Y', $date);
    }

    public function parserName(): string
    {
        return 'Laravel-News';
    }
}
