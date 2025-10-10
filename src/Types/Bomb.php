<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\BombState;
use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class Bomb
{
    use ParserConstructor;

    public BombState $state;

    public string $position;

    public string|null $player = null;

    public string|null $countdown = null;
}
