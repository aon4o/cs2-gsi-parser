<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

class Team
{
    public string|null $name = null;

    public int $score;

    public int $consecutive_round_losses;

    public int $timeouts_remaining;

    public int $matches_won_this_series;
}
