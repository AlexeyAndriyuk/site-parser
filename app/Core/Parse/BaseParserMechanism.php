<?php

namespace App\Core\Parse;

use App\Core\Contracts\IDocLoader;

abstract class BaseParserMechanism
{
    public function __construct(protected IDocLoader $docLoader) {}
}
