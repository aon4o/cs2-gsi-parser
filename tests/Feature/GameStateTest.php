<?php

declare(strict_types=1);

use Aon4o\Cs2GsiParser\Enums\Custom\GameStateType;
use Aon4o\Cs2GsiParser\GameState;

beforeEach()->group('parser');

test('parse from json string returns Menu', function () {
    $json = loadFixture('menu');

    $gs = GameState::from($json);

    expect($gs->type())->toBe(GameStateType::MENU)
        ->and($gs->provider->appid)->toBe(730)
        ->and($gs->player->activity->value)->toBe('menu');
});

test('parse from array returns Playing (warmup)', function () {
    $array = json_decode(loadFixture('warmup'), true);

    $gs = GameState::from($array);

    expect($gs->type())->toBe(GameStateType::PLAYING)
        ->and($gs->map->phase->value)->toBe('warmup');
});

test('parse from object returns Playing (freezetime)', function () {
    $obj = json_decode(loadFixture('freezetime'));

    $gs = GameState::from($obj);

    expect($gs->type())->toBe(GameStateType::PLAYING)
        ->and($gs->round->phase->value)->toBe('freezetime')
        ->and($gs->player->activity->value)->toBe('textinput');
});

test('parse live bomb payload returns Playing with planted bomb', function () {
    $obj = json_decode(loadFixture('live_bomb'));

    $gs = GameState::from($obj);

    expect($gs->type())->toBe(GameStateType::PLAYING)
        ->and($gs->round->bomb->value)->toBe('planted')
        ->and($gs->added)->not->toBeNull();
});

// New test to exercise Spectating and many types
test('parse spectating payload returns Spectating and populates complex types', function () {
    $obj = json_decode(loadFixture('spectating_full'));

    $gs = GameState::from($obj);

    expect($gs->type())->toBe(GameStateType::SPECTATING)
        ->and($gs->map->name)->toBe('de_inferno')
        ->and($gs->map->current_spectators)->toBe(5)
        ->and($gs->round->phase->value)->toBe('live')
        ->and($gs->round->bomb->value)->toBe('planted')
        ->and($gs->bomb->state->value)->toBe('planted')
        ->and($gs->bomb->position)->toBe('50 60 70')
        ->and(is_array($gs->allplayers))->toBeTrue();

    // map

    // round and bomb

    // allplayers
    $keys = array_keys((array) $gs->allplayers);
    expect(count($keys))->toBeGreaterThanOrEqual(2);

    // check a specific player
    $playerOne = $gs->allplayers['76561198000000001'];
    expect($playerOne->name)->toBe('PlayerOne')
        ->and($playerOne->state->health)->toBe(100)
        ->and($playerOne->weapons['weapon_0']->name->value)->toBe('weapon_ak47')
        ->and(is_array($gs->grenades))->toBeTrue();
    // weapon name is an enum; assert its backing value

    // grenades
    $grenade = $gs->grenades['grenade_0'];
    // grenade name is an enum; assert case name or backing value
    expect($grenade->name->name)->toBe('FRAG')
        ->and($gs->previously->map->phase->value)->toBe('warmup')
        ->and($gs->previously->player->activity->value)->toBe('playing')
        ->and($gs->auth->token)->toBe('SPECTOKEN');

    // previously

    // auth
});
