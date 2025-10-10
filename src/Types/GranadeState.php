<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\GrenadeType;
use Aon4o\Cs2GsiParser\Enums\WeaponType;
use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class GranadeState
{
    use ParserConstructor;

    public GrenadeType $name;

    public WeaponType $type = WeaponType::Grenade;

    public string $position;
}
