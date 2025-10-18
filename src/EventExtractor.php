<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser;

use Aon4o\Cs2GsiParser\Differs\MapDiffer;
use Aon4o\Cs2GsiParser\Differs\PlayerDiffer;
use Aon4o\Cs2GsiParser\Differs\PlayerStateDiffer;
use Aon4o\Cs2GsiParser\Differs\RoundDiffer;
use Aon4o\Cs2GsiParser\Enums\Custom\Event;

class EventExtractor
{
    public function __construct(public GameState|null $previous = null, public GameState $current)
    {
        if ($this->previous !== null) {
            $this->previous = GameState::from([]);
        }
    }

    /**
     * @return array<Event>
     */
    public function allEvents(): array
    {
        return [
            ...$this->mapEvents(),
            ...$this->playerEvents(),
            ...$this->roundEvents(),
        ];
    }

    /**
     * @return array<Event>
     */
    public function mapEvents(): array
    {
        return MapDiffer::diff($this->previous, $this->current);
    }

    /**
     * @return array<Event>
     */
    public function playerEvents(): array
    {
        return [
            ...PlayerDiffer::diff($this->previous, $this->current),
            ...PlayerStateDiffer::diff($this->current, $this->previous),
        ];
    }

    /**
     * @return array<Event>
     */
    public function roundEvents(): array
    {
        return RoundDiffer::diff($this->previous, $this->current);
    }
}
