<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums;

enum RoundWinType: string
{
    case CT_WIN_TIME = 'ct_win_time';
    case CT_WIN_ELIMINATION = 'ct_win_elimination';
    case T_WIN_ELIMINATION = 't_win_elimination';
    case T_WIN_BOMB = 't_win_bomb';
    case CT_WIN_DEFUSE = 'ct_win_defuse';
}
