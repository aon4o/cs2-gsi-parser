<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser;

class GSIConfigWriter
{
    public static function generate(
        string $url,
        string $auth_token,
        string $name = 'cs2-gsi',
        bool $map_round_wins = true,
        bool $map = true,
        bool $player_id = true,
        bool $player_match_stats = true,
        bool $player_state = true,
        bool $player_weapons = true,
        bool $provider = true,
        bool $round = true,
        bool $allgrenades = true,
        bool $allplayers_id = true,
        bool $allplayers_match_stats = true,
        bool $allplayers_position = true,
        bool $allplayers_state = true,
        bool $allplayers_weapons = true,
        bool $bomb = true,
        bool $phase_countdowns = true,
        bool $player_position = true,
    ): string {
        $config = <<<EOT
"{$name}"
{
    "uri" "{$url}"
    "timeout" "5.0"
    "buffer"  "0.1"
    "throttle" "0.1"
    "heartbeat" "30.0"
    "auth"
    {
        "token" "{$auth_token}"
    }
    "data"
    {

EOT;

        $options = compact(
            'map_round_wins',
            'map',
            'player_id',
            'player_match_stats',
            'player_state',
            'player_weapons',
            'provider',
            'round',
            'allgrenades',
            'allplayers_id',
            'allplayers_match_stats',
            'allplayers_position',
            'allplayers_state',
            'allplayers_weapons',
            'bomb',
            'phase_countdowns',
            'player_position',
        );

        foreach ($options as $key => $enabled) {
            $value = $enabled ? '1' : '0';
            $config .= <<<EOT
        "{$key}" "{$value}"

EOT;
        }

        $config .= <<<'EOT'
    }
EOT;

        $config .= "\n}\n";

        return $config;
    }
}
