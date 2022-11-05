<?php

namespace App\Core\Parse;

use App\Core\Contracts\IDocLoader;
use KubAT\PhpSimple\HtmlDomParser;
use simple_html_dom\simple_html_dom;

class FileLoader implements IDocLoader
{
    public function __construct(
        private string $fileName
    ) {}

    public function loadDocument($uri): simple_html_dom
    {
        return HtmlDomParser::file_get_html($this->fileName);
    }
}
