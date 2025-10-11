<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Differs;

use Aon4o\Cs2GsiParser\Enums\Custom\Event;

class PlayerDiffer extends BaseDiffer
{
    public const array FIELDS = [
        'player.team' => Event::PLAYER_TEAM_CHANGED,
        'player.activity' => Event::PLAYER_ACTIVITY_CHANGED,
        'player.observer_slot' => Event::PLAYER_OBSERVER_SLOT_CHANGED,
    ];
}
