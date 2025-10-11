<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Differs;

use Aon4o\Cs2GsiParser\Enums\Custom\Event;

class MapDiffer extends BaseDiffer
{
    public const array FIELDS = [
        'map.name' => Event::MAP_CHANGED,
        'map.phase' => Event::MAP_PHASE_CHANGED,
        'map.round' => Event::MAP_ROUND_CHANGED,
        'map.team_ct.score' => Event::MAP_CT_SCORE_CHANGED,
        'map.team_t.score' => Event::MAP_T_SCORE_CHANGED,
    ];
}
