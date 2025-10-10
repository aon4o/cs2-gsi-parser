<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\WeaponType;
use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

abstract class Weapon
{
    use ParserConstructor;

    public WeaponType $type;
}
