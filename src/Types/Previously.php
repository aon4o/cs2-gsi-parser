<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Traits\ParserConstructor;
use Aon4o\Cs2GsiParser\Types\Weapon\Grenade;

class Previously
{
    use ParserConstructor;

    public Provider|null $provider = null;

    public Map|null $map = null;

    public Round|null $round = null;

    public Player|null $player = null;

    /** @var array<string, OtherPlayer>|null */
    public array|null $allplayers = null;

    public Phase|null $phase_countdowns = null;

    /** @var array<string, Grenade>|null */
    public array|null $grenades = null;

    public Bomb|null $bomb = null;

    public Auth|null $auth = null;
}
