<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class Team
{
    use ParserConstructor;

    public string|null $name = null;

    public int $score;

    public int $consecutive_round_losses;

    public int $timeouts_remaining;

    public int $matches_won_this_series;
}
