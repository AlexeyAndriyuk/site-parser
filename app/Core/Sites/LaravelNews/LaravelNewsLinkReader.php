<?php

namespace App\Core\Sites\LaravelNews;

use App\Core\Parse\BaseLinkListReader;

class LaravelNewsLinkReader extends BaseLinkListReader
{
    private string $domain = 'https://laravel-news.com';

    public function getLinks($pageNumber): array
    {
        $url = $this->domain . "/blog" . ($pageNumber > 1 ? '?page=' . $pageNumber : '' );

        $dom = $this->docLoader->loadDocument($url);

        $links = [];

        foreach ($dom->find("main ul li.group-link-underline") as $link) {
            $links[] = $this->domain . $link->firstChild()->href;
        }
        return $links;
    }
}
