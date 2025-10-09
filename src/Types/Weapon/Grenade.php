<?php

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\Weapon\Grenade as GrenadeWeapon;
use Aon4o\Cs2GsiParser\Enums\WeaponState;
use Aon4o\Cs2GsiParser\Enums\WeaponType;

class Grenade extends Weapon
{
    public WeaponType $type = WeaponType::Grenade;

    public GrenadeWeapon $name;

    public string $paintkit;

    public int $ammo_reserve;

    public WeaponState $state;
}
