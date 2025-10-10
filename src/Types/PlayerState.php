<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class PlayerState
{
    use ParserConstructor;

    public int $health;

    public int $armor;

    public bool $helmet;

    public int $flashed;

    public int $smoked;

    public int $burning;

    public int $money;

    public int $round_kills;

    public int $round_killhs;

    public int $round_totaldmg;

    public int $equip_value;

    public bool|null $defusekit;
}
