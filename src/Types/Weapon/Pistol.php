<?php

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\Weapon\Pistol as PistolWeapon;
use Aon4o\Cs2GsiParser\Enums\WeaponState;
use Aon4o\Cs2GsiParser\Enums\WeaponType;

class Pistol extends Weapon
{
    public WeaponType $type = WeaponType::Pistol;

    public PistolWeapon $name;

    public string $paintkit;

    public int $ammo_clip;

    public int $ammo_clip_max;

    public int $ammo_reserve;

    public WeaponState $state;
}
