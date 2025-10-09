<?php

namespace Aon4o\Cs2GsiParser\GameStates;

use Aon4o\Cs2GsiParser\Types\Auth;
use Aon4o\Cs2GsiParser\Types\Player;
use Aon4o\Cs2GsiParser\Types\Provider;

abstract class BaseState
{
    public Provider $provider;

    public Player|null $player = null;

    public Auth $auth;
}
