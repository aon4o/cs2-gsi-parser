<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

/**
 * TODO: find and list all modes then set type on map.mode
 */
enum MapMode: string
{
    case COMPETITIVE = 'competitive';
    case CASUAL = 'casual';
    case scrimcomp2v2 = 'scrimcomp2v2';
}
