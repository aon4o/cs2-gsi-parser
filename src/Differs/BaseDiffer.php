<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Differs;

use Aon4o\Cs2GsiParser\Enums\Custom\Event;
use Aon4o\Cs2GsiParser\GameState;

abstract class BaseDiffer
{
    /**
     * @var array<string, Event>
     */
    public const array FIELDS = [];

    /**
     * @param  GameState  $previous
     * @param  GameState  $current
     *
     * @return array<Event>
     */
    public static function diff(GameState $previous, GameState $current): array
    {
        $events = [];

        foreach (static::FIELDS as $field => $event) {
            $prev_value = data_get($previous, $field);
            $curr_value = data_get($current, $field);

            if ($prev_value !== $curr_value) {
                $events[] = $event;
            }
        }

        return $events;
    }
}
