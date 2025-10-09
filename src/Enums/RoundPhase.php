<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum RoundPhase: string
{
    case LIVE = 'live';
    case FREEZETIME = 'freezetime';
    case OVER = 'over';
}
