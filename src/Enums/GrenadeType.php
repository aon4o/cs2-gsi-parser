<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum GrenadeType: string
{
    case INFERNO = 'inferno';
    case SMOKE = 'smoke';
    case FLASH_BANG = 'flashbang';
    case FRAG = 'frag';
    case DECOY = 'decoy';

    public function isDecoySmoke()
    {
        return $this === self::DECOY || $this === self::SMOKE;
    }

    public function isDefault()
    {
        return $this === self::FRAG || $this === self::FLASH_BANG;
    }

    public function isFireBomb()
    {
        return $this === self::INFERNO;
    }
}
