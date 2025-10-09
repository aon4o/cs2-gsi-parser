<?php

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\MapPhase;
use Aon4o\Cs2GsiParser\Enums\RoundWinType;

class Map
{
    public string $mode;

    public string $name;

    public MapPhase $phase;

    public int $round;

    public Team $team_ct;

    public Team $team_t;

    public int $num_matches_to_win_series;

    public int $current_spectators;

    public int $souvenirs_total;

    /** @var array<string, RoundWinType>|null */
    public array|null $round_wins = null;
}
