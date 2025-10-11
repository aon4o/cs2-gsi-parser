<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser;

class GSIConfigWriter
{
    public string $url = 'http://localhost:8000';

    public string $auth_token = '';

    public string $name = 'cs2-gsi';

    /**
     * @var array<string, float>
     */
    public array $settings = [
        'timeout' => 5.0,
        'buffer' => 0.1,
        'throttle' => 0.1,
        'heartbeat' => 30.0,
    ];

    /**
     * @var array<string, bool>
     */
    public array $data = [
        'map_round_wins' => true,
        'map' => true,
        'player_id' => true,
        'player_match_stats' => true,
        'player_state' => true,
        'player_weapons' => true,
        'provider' => true,
        'round' => true,
        'allgrenades' => true,
        'allplayers_id' => true,
        'allplayers_match_stats' => true,
        'allplayers_position' => true,
        'allplayers_state' => true,
        'allplayers_weapons' => true,
        'bomb' => true,
        'phase_countdowns' => true,
        'player_position' => true,
    ];

    public function __construct() {}

    public static function new(): GSIConfigWriter
    {
        return new self();
    }

    public function setUrl(string $url): GSIConfigWriter
    {
        $this->url = $url;

        return $this;
    }

    public function setAuthToken(string $token): GSIConfigWriter
    {
        $this->auth_token = $token;

        return $this;
    }

    public function setName(string $name): GSIConfigWriter
    {
        $this->name = $name;

        return $this;
    }

    public function setSettings(
        float|null $timeout = null,
        float|null $buffer = null,
        float|null $throttle = null,
        float|null $heartbeat = null,
    ): GSIConfigWriter {
        if ($timeout !== null) {
            $this->settings['timeout'] = $timeout;
        }
        if ($buffer !== null) {
            $this->settings['buffer'] = $buffer;
        }
        if ($throttle !== null) {
            $this->settings['throttle'] = $throttle;
        }
        if ($heartbeat !== null) {
            $this->settings['heartbeat'] = $heartbeat;
        }

        return $this;
    }

    public function setData(
        bool $map_round_wins,
        bool $map,
        bool $player_id,
        bool $player_match_stats,
        bool $player_state,
        bool $player_weapons,
        bool $provider,
        bool $round,
        bool $allgrenades,
        bool $allplayers_id,
        bool $allplayers_match_stats,
        bool $allplayers_position,
        bool $allplayers_state,
        bool $allplayers_weapons,
        bool $bomb,
        bool $phase_countdowns,
        bool $player_position,
    ): GSIConfigWriter {
        $this->data = [
            'map_round_wins' => $map_round_wins,
            'map' => $map,
            'player_id' => $player_id,
            'player_match_stats' => $player_match_stats,
            'player_state' => $player_state,
            'player_weapons' => $player_weapons,
            'provider' => $provider,
            'round' => $round,
            'allgrenades' => $allgrenades,
            'allplayers_id' => $allplayers_id,
            'allplayers_match_stats' => $allplayers_match_stats,
            'allplayers_position' => $allplayers_position,
            'allplayers_state' => $allplayers_state,
            'allplayers_weapons' => $allplayers_weapons,
            'bomb' => $bomb,
            'phase_countdowns' => $phase_countdowns,
            'player_position' => $player_position,
        ];

        return $this;
    }

    public function text(): string
    {
        $config = <<<EOT
"$this->name"
{
    "uri" "$this->url"
    "timeout" "{$this->settings['timeout']}"
    "buffer"  "{$this->settings['buffer']}"
    "throttle" "{$this->settings['throttle']}"
    "heartbeat" "{$this->settings['heartbeat']}"
    "auth"
    {
        "token" "$this->auth_token"
    }
    "data"
    {

EOT;

        foreach ($this->data as $key => $enabled) {
            $value = $enabled ? '1' : '0';
            $config .= <<<EOT
        "$key" "$value"

EOT;
        }

        $config .= <<<'EOT'
    }
EOT;

        $config .= "\n}\n";

        return $config;
    }
}
