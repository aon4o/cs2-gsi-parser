<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\ObservatorSlot;
use Aon4o\Cs2GsiParser\Enums\PlayerActivity;
use Aon4o\Cs2GsiParser\Enums\Team as TeamType;
use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class Player
{
    use ParserConstructor;

    public string|null $clan = null;

    public string $steamid;

    public string $name;

    public ObservatorSlot|null $observer_slot = null;

    public TeamType|null $team = null;

    public PlayerActivity $activity;

    public PlayerState|null $state = null;

    public string|null $position = null;

    public string|null $forward = null;

    public string|null $spectarget = null;
}
