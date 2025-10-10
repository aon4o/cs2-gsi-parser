<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\GameStates;

use Aon4o\Cs2GsiParser\Types\Added;
use Aon4o\Cs2GsiParser\Types\Map;
use Aon4o\Cs2GsiParser\Types\Previously;
use Aon4o\Cs2GsiParser\Types\Round;

class Playing extends GameState
{
    public Map $map;

    public Round $round;

    public Previously|null $previously = null;

    public Added|null $added = null;
}
