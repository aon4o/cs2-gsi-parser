<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum WeaponType: string
{
    case C4 = 'C4';
    case Grenade = 'Grenade';
    case Knife = 'Knife';
    case MachineGun = 'Machine Gun';
    case Pistol = 'Pistol';
    case Rifle = 'Rifle';
    case Shotgun = 'Shotgun';
    case SniperRifle = 'SniperRifle';
    case SubmachineGun = 'Submachine Gun';
}
