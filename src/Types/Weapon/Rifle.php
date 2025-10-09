<?php

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\Weapon\Rifle as RifleWeapon;
use Aon4o\Cs2GsiParser\Enums\WeaponState;
use Aon4o\Cs2GsiParser\Enums\WeaponType;

class Rifle extends Weapon
{
    public WeaponType $type = WeaponType::Rifle;

    public RifleWeapon $name;

    public string $paintkit;

    public int $ammo_clip;

    public int $ammo_clip_max;

    public int $ammo_reserve;

    public WeaponState $state;
}
