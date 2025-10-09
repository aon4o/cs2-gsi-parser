<?php

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\Weapon\Knife as KnifeWeapon;
use Aon4o\Cs2GsiParser\Enums\WeaponState;
use Aon4o\Cs2GsiParser\Enums\WeaponType;

class Knife extends Weapon
{
    public WeaponType $type = WeaponType::Knife;

    public KnifeWeapon $name;

    public string $paintkit;

    public WeaponState $state;
}
