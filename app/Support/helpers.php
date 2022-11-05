<?php

use Illuminate\Support\Str;

function uniqueHash(): string
{
    return md5(bcrypt(Str::random()).time())
        . '_' . time()
        . '_' . preg_replace('/\s+/', '', Str::random(32));
}
