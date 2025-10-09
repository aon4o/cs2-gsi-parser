<?php

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\Weapon\SniperRifle as SniperRifleWeapon;
use Aon4o\Cs2GsiParser\Enums\WeaponState;
use Aon4o\Cs2GsiParser\Enums\WeaponType;

class SniperRifle extends Weapon
{
    public WeaponType $type = WeaponType::SniperRifle;

    public SniperRifleWeapon $name;

    public string $paintkit;

    public int $ammo_clip;

    public int $ammo_clip_max;

    public int $ammo_reserve;

    public WeaponState $state;
}
