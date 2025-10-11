<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser;

use Aon4o\Cs2GsiParser\Enums\Custom\GameStateType;
use Aon4o\Cs2GsiParser\Traits\ParserConstructor;
use Aon4o\Cs2GsiParser\Types\Added;
use Aon4o\Cs2GsiParser\Types\Auth;
use Aon4o\Cs2GsiParser\Types\Bomb;
use Aon4o\Cs2GsiParser\Types\GranadeState;
use Aon4o\Cs2GsiParser\Types\Map;
use Aon4o\Cs2GsiParser\Types\OtherPlayer;
use Aon4o\Cs2GsiParser\Types\Phase;
use Aon4o\Cs2GsiParser\Types\Player;
use Aon4o\Cs2GsiParser\Types\Previously;
use Aon4o\Cs2GsiParser\Types\Provider;
use Aon4o\Cs2GsiParser\Types\Round;

class GameState
{
    use ParserConstructor;

    public Provider $provider;

    public Player|null $player = null;

    public Auth $auth;

    public Map|null $map;

    public Round|null $round = null;

    public Previously|null $previously = null;

    public Added|null $added = null;

    /** @var array<string, OtherPlayer>|null */
    public array|null $allplayers = null;

    public Phase|null $phase_countdowns = null;

    /** @var array<string, GranadeState>|null */
    public array|null $grenades = null;

    public Bomb|null $bomb = null;

    public function type(): GameStateType
    {
        if (isset($this->allplayers) && $this->allplayers) {
            return GameStateType::SPECTATING;
        }

        if (isset($this->map) && $this->map) {
            return GameStateType::PLAYING;
        }

        return GameStateType::MENU;
    }
}
