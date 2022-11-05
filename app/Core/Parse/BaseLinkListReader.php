<?php

namespace App\Core\Parse;

abstract class BaseLinkListReader extends BaseParserMechanism
{
    abstract public function getLinks(int $pageNumber): array;
}
