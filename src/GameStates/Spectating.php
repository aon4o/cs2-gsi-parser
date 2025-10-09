<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\GameStates;

use Aon4o\Cs2GsiParser\Types\Bomb;
use Aon4o\Cs2GsiParser\Types\Map;
use Aon4o\Cs2GsiParser\Types\OtherPlayer;
use Aon4o\Cs2GsiParser\Types\Phase;
use Aon4o\Cs2GsiParser\Types\Previously;
use Aon4o\Cs2GsiParser\Types\Round;
use Aon4o\Cs2GsiParser\Types\Weapon\Grenade;

class Spectating extends BaseState
{
    public Map $map;

    public Round|null $round;

    /** @var array<string, OtherPlayer> */
    public array $allplayers;

    public Phase $phase_countdowns;

    /** @var array<string, Grenade> */
    public array $grenades;

    public Previously $previously;

    public Bomb $bomb;
}
