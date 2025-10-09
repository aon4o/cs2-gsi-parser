<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum PlayerActivity: string
{
    case PLAYING = 'playing';
    case FREE = 'free';
    case TEXT_INPUT = 'textinput';
    case MENU = 'menu';
}
