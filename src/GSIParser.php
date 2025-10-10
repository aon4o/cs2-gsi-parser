<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser;

use Aon4o\Cs2GsiParser\GameStates\GameState;
use Aon4o\Cs2GsiParser\GameStates\Menu;
use Aon4o\Cs2GsiParser\GameStates\Playing;
use Aon4o\Cs2GsiParser\GameStates\Spectating;
use InvalidArgumentException;

class GSIParser
{
    /**
     * @param  mixed  $data
     *
     * @return GameState
     *
     * @throws InvalidArgumentException
     */
    public static function parse(mixed $data = null): GameState
    {
        $data = '{
            "provider": {
                "name": "Counter-Strike: Global Offensive",
                "appid": 730,
                "version": 14108,
                "steamid": "76561198067092241",
                "timestamp": 1759002280
            },
            "map": {
                "mode": "competitive",
                "name": "de_dust2",
                "phase": "live",
                "round": 0,
                "team_ct": {
                    "score": 0,
                    "consecutive_round_losses": 1,
                    "timeouts_remaining": 1,
                    "matches_won_this_series": 0
                },
                "team_t": {
                    "score": 0,
                    "consecutive_round_losses": 1,
                    "timeouts_remaining": 1,
                    "matches_won_this_series": 0
                },
                "num_matches_to_win_series": 0
            },
            "round": {
                "phase": "live"
            },
            "player": {
                "steamid": "76561198067092241",
                "name": "MF BOOM ⛟",
                "observer_slot": 1,
                "team": "T",
                "activity": "playing",
                "state": {
                    "health": 100,
                    "armor": 0,
                    "helmet": false,
                    "flashed": 0,
                    "smoked": 0,
                    "burning": 0,
                    "money": 800,
                    "round_kills": 0,
                    "round_killhs": 0,
                    "equip_value": 200
                },
                "weapons": {
                    "weapon_0": {
                        "name": "weapon_knife",
                        "paintkit": "default",
                        "type": "Knife",
                        "state": "holstered"
                    },
                    "weapon_1": {
                        "name": "weapon_hkp2000",
                        "paintkit": "cu_p2000_decline",
                        "type": "Pistol",
                        "ammo_clip": 13,
                        "ammo_clip_max": 13,
                        "ammo_reserve": 52,
                        "state": "active"
                    }
                },
                "match_stats": {
                    "kills": 0,
                    "assists": 0,
                    "deaths": 0,
                    "mvps": 0,
                    "score": 0
                }
            },
            "previously": {
                "round": {
                    "phase": "freezetime"
                }
            },
            "auth": {
                "token": "CCWJu64ZV3JHDT8hZc"
            }
        }';
        $data_type = gettype($data);

        return match ($data_type) {
            'string' => self::fromJSON($data),
            'array' => self::fromArray($data),
            'object' => self::fromObject($data),
            default => throw new InvalidArgumentException('Invalid data type: ' . $data_type),
        };
    }

    public static function fromJSON(string $data): GameState
    {
        return self::fromArray(json_decode($data, true));
    }

    public static function fromArray(array $data): GameState
    {
        return self::fromObject(json_decode(json_encode($data)));
    }

    public static function fromObject(object $data): GameState
    {
        if ($data->allplayers) {
            return new Spectating($data);
        }

        if ($data->map) {
            return new Playing($data);
        }

        return new Menu($data);
    }
}
