<?php

declare(strict_types=1);

use Aon4o\Cs2GsiParser\Enums\GrenadeType;
use Aon4o\Cs2GsiParser\Enums\ObservatorSlot;
use Aon4o\Cs2GsiParser\Types\Bomb;
use Aon4o\Cs2GsiParser\Types\Player;
use Aon4o\Cs2GsiParser\Types\Team;

beforeEach()->group('unit');

test('grenade type helper methods', function () {
    expect(GrenadeType::DECOY->isDecoySmoke())->toBeTrue();
    expect(GrenadeType::SMOKE->isDecoySmoke())->toBeTrue();
    expect(GrenadeType::FRAG->isDefault())->toBeTrue();
    expect(GrenadeType::FLASH_BANG->isDefault())->toBeTrue();
    expect(GrenadeType::INFERNO->isFireBomb())->toBeTrue();
});

test('player observer_slot accepts numeric string and maps to ObservatorSlot', function () {
    $obj = json_decode(json_encode(['steamid' => '1', 'name' => 'X', 'observer_slot' => '1', 'activity' => 'playing']));

    $player = new Player($obj);

    expect($player->observer_slot)->toBeInstanceOf(ObservatorSlot::class);
    expect($player->observer_slot->value)->toBe(1);
});

test('team casts numeric strings to ints', function () {
    $team = new Team(json_decode(json_encode([
        'score' => '5', 'consecutive_round_losses' => '2', 'timeouts_remaining' => '1', 'matches_won_this_series' => '0',
    ])));

    expect($team->score)->toBeInt()->toBe(5);
    expect($team->consecutive_round_losses)->toBeInt()->toBe(2);
});

test('bomb maps state enum and keeps other fields', function () {
    $obj = json_decode(json_encode([
        'state' => 'planted', 'position' => '10 20 30', 'player' => '765', 'countdown' => '40',
    ]));

    $bomb = new Bomb($obj);

    expect($bomb->state)->not->toBeNull();
    expect($bomb->state->value)->toBe('planted');
    expect($bomb->position)->toBe('10 20 30');
    expect($bomb->player)->toBe('765');
});
