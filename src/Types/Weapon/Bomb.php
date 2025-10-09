<?php

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\WeaponState;
use Aon4o\Cs2GsiParser\Enums\WeaponType;

class Bomb extends Weapon
{
    public WeaponType $type = WeaponType::C4;

    public string $name = 'weapon_c4';

    public string $paintkit;

    public WeaponState $state;
}
