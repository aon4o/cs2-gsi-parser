<?php

namespace Aon4o\Cs2GsiParser\Types\Weapon;

use Aon4o\Cs2GsiParser\Enums\Weapon\MachineGun as MachineGunWeapon;
use Aon4o\Cs2GsiParser\Enums\WeaponState;
use Aon4o\Cs2GsiParser\Enums\WeaponType;

class MachineGun extends Weapon
{
    public WeaponType $type = WeaponType::MachineGun;

    public MachineGunWeapon $name;

    public string $paintkit;

    public int $ammo_clip;

    public int $ammo_clip_max;

    public int $ammo_reserve;

    public WeaponState $state;
}
