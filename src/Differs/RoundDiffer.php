<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Differs;

use Aon4o\Cs2GsiParser\Enums\Custom\Event;

class RoundDiffer extends BaseDiffer
{
    public const array FIELDS = [
        'round.phase' => Event::ROUND_PHASE_CHANGED,
        'round.bomb' => Event::ROUND_BOMB_STATE_CHANGED,
        'round.win_team' => Event::ROUND_WIN_TEAM_CHANGED,
    ];
}
