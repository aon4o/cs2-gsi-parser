<?php

namespace Aon4o\Cs2GsiParser\Enums\Weapon;

enum Grenade: string
{
    case SMOKE = 'weapon_smokegrenade';

    case DECOY = 'weapon_decoy';

    case FRAG = 'weapon_hegrenade';

    case INFERNO = 'weapon_incgrenade';

    case MOLOTOV = 'weapon_molotov';
}
