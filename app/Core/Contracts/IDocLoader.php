<?php

namespace App\Core\Contracts;

use simple_html_dom\simple_html_dom;

interface IDocLoader
{
    public function loadDocument($uri): simple_html_dom;
}
