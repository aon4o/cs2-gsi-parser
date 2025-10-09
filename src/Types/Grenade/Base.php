<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types\Grenade;

use Aon4o\Cs2GsiParser\Enums\Weapon\Grenade;

abstract class Base
{
    public int $owner;

    public Grenade $type;

    public string $lifetime;
}
