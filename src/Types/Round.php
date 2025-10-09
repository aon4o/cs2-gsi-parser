<?php

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\RoundBombState;
use Aon4o\Cs2GsiParser\Enums\RoundPhase;
use Aon4o\Cs2GsiParser\Enums\Team as TeamType;

class Round
{
    public RoundPhase $phase;

    public RoundBombState $bomb;

    public TeamType $win_team;
}
