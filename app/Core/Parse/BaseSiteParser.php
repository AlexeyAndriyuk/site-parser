<?php

namespace App\Core\Parse;

use App\Core\Contracts\IDocLoader;
use simple_html_dom\simple_html_dom;

abstract class BaseSiteParser extends BaseParserMechanism
{
    protected string $uri;

    protected simple_html_dom $dom;

    public function __construct(IDocLoader $docLoader, $uri)
    {
        parent::__construct($docLoader);

        $this->uri = $uri;
        $this->dom = $docLoader->loadDocument($uri);
    }

    abstract public function title();
    abstract public function description();
    abstract public function image();
    abstract public function publishedAt();
    abstract public function parserName();
}
