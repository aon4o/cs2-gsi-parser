<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class PlayerStats
{
    use ParserConstructor;

    public int $kills;

    public int $assists;

    public int $deaths;

    public int $mvps;

    public int $score;
}
