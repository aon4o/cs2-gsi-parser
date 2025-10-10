<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\ObservatorSlot;
use Aon4o\Cs2GsiParser\Enums\Team as TeamType;
use Aon4o\Cs2GsiParser\Traits\ParserConstructor;
use Aon4o\Cs2GsiParser\Types\Weapon\Weapon;

class OtherPlayer
{
    use ParserConstructor;

    public string|null $clan = null;

    public string $name;

    public ObservatorSlot $observer_slot;

    public TeamType $team;

    public PlayerState $state;

    public PlayerStats $match_stats;

    /** @var array<int, Weapon> */
    public array $weapons;

    public string $position;

    public string $forward;
}
