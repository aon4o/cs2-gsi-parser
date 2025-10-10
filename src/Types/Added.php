<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class Added
{
    use ParserConstructor;

    //   round?: {
    //      bomb?: boolean
    //      win_team?: boolean
    //    }
    //    map?: Map

    public Round|null $round = null; // TODO

    public Map|null $map = null;
}
