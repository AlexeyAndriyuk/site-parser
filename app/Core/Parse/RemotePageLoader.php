<?php

namespace App\Core\Parse;

use App\Core\Contracts\IDocLoader;
use App\Core\Parse\Exceptions\CantReadUriException;
use GuzzleHttp\Client;
use KubAT\PhpSimple\HtmlDomParser;
use simple_html_dom\simple_html_dom;

class RemotePageLoader implements IDocLoader
{
    public function __construct(
        private array $options = []
    ) {}

    public function loadDocument($uri): simple_html_dom
    {
        $client = new Client();
        $response = $client->get($uri, $this->options);

        $dom = HtmlDomParser::str_get_html($response->getBody()->getContents());

        if (! $dom) {
            throw new CantReadUriException('DOM cannot be parse');
        }

        return $dom;
    }
}
