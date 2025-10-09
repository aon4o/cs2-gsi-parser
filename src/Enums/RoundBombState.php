<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum RoundBombState: string
{
    case PLANTED = 'planted';
    case EXPLODED = 'exploded';
    case DEFUSED = 'defused';
}
