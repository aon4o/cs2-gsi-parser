<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Differs;

use Aon4o\Cs2GsiParser\Enums\Custom\Event;

class PlayerStateDiffer extends BaseDiffer
{
    public const array FIELDS = [
        'player.state.health' => Event::PLAYER_HP_CHANGED,
        'player.state.armor' => Event::PLAYER_ARMOR_CHANGED,
        'player.state.helmet' => Event::PLAYER_HELMET_CHANGED,
        'player.state.money' => Event::PLAYER_MONEY_CHANGED,
        'player.state.flashed' => Event::PLAYER_FLASHED_CHANGED,
        'player.state.smoked' => Event::PLAYER_SMOKED_CHANGED,
        'player.state.burning' => Event::PLAYER_BURNING_CHANGED,
        'player.state.equipValue' => Event::PLAYER_EQUIP_VALUE_CHANGED,
    ];
}
