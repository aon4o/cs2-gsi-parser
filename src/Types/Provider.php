<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class Provider
{
    use ParserConstructor;

    public string $name;

    public int $appid;

    public int $version;

    public string $steamid;

    public int $timestamp;
}
