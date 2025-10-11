<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums\Custom;

enum GameStateType: string
{
    case MENU = 'menu';
    case PLAYING = 'playing';
    case SPECTATING = 'spectating';
}
