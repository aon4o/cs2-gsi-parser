<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Enums\Custom;

enum Event: string
{
    case MAP_CHANGED = 'map.changed';
    case MAP_PHASE_CHANGED = 'map.phase_changed';
    case MAP_ROUND_CHANGED = 'map.round_changed';
    case MAP_CT_SCORE_CHANGED = 'map.ct_score_changed';
    case MAP_T_SCORE_CHANGED = 'map.t_score_changed';

    case PLAYER_TEAM_CHANGED = 'player.team_changed';
    case PLAYER_ACTIVITY_CHANGED = 'player.activity_changed';
    case PLAYER_OBSERVER_SLOT_CHANGED = 'player.observer_slot_changed';

    case ROUND_PHASE_CHANGED = 'round.phase_changed';
    case ROUND_BOMB_STATE_CHANGED = 'round.bomb_state_changed';
    case ROUND_WIN_TEAM_CHANGED = 'round.win_team_changed';

    case PLAYER_HP_CHANGED = 'player.hp_changed';
    case PLAYER_ARMOR_CHANGED = 'player.armor_changed';
    case PLAYER_HELMET_CHANGED = 'player.helmet_changed';
    case PLAYER_MONEY_CHANGED = 'player.money_changed';
    case PLAYER_FLASHED_CHANGED = 'player.flashed_changed';
    case PLAYER_SMOKED_CHANGED = 'player.smoked_changed';
    case PLAYER_BURNING_CHANGED = 'player.burning_changed';
    case PLAYER_EQUIP_VALUE_CHANGED = 'player.equip_value_changed';
}
