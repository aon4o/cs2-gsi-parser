<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum BombState: string
{
    case PLANTED = 'planted';
    case PLANTING = 'planting';
    case EXPLODED = 'exploded';
    case DEFUSING = 'defusing';
    case DEFUSED = 'defused';
    case CARRIED = 'carried';
    case DROPPED = 'dropped';
}
