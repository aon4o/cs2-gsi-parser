<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum PhaseType: string
{
    case FREEZETIME = 'freezetime';
    case BOMB = 'bomb';
    case WARMUP = 'warmup';
    case LIVE = 'live';
    case OVER = 'over';
    case DEFUSE = 'defuse';
    case PAUSED = 'paused';
    case TIMEOUT_CT = 'timeout_ct';
    case TIMEOUT_T = 'timeout_t';
}
