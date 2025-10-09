<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum MapPhase: string
{
    case LIVE = 'live';
    case INTERMISSION = 'intermission';
    case GAMEOVER = 'gameover';
    case WARMUP = 'warmup';
}
