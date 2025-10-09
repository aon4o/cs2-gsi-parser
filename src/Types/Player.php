<?php

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\ObservatorSlot;
use Aon4o\Cs2GsiParser\Enums\PlayerActivity;
use Aon4o\Cs2GsiParser\Enums\Team as TeamType;

class Player
{
    public string|null $clan = null;

    public string $steamid;

    public string $name;

    public ObservatorSlot|null $observer_slot;

    public TeamType|null $team;

    public PlayerActivity $activity;

    public PlayerState|null $state;

    public string|null $position;

    public string|null $forward;

    public string|null $spectarget = null;
}
