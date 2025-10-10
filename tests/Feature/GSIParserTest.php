<?php

declare(strict_types=1);

use Aon4o\Cs2GsiParser\GameStates\Menu;
use Aon4o\Cs2GsiParser\GameStates\Playing;
use Aon4o\Cs2GsiParser\GameStates\Spectating;
use Aon4o\Cs2GsiParser\GSIParser;

beforeEach()->group('parser');

test('parse from json string returns Menu', function () {
    $json = file_get_contents(__DIR__ . '/../Fixtures/menu.json');

    $gs = GSIParser::parse($json);

    expect($gs)->toBeInstanceOf(Menu::class);
    expect($gs->provider->appid)->toBe(730);
    expect($gs->player->activity->value)->toBe('menu');
});

test('parse from array returns Playing (warmup)', function () {
    $array = json_decode(file_get_contents(__DIR__ . '/../Fixtures/warmup.json'), true);

    $gs = GSIParser::parse($array);

    expect($gs)->toBeInstanceOf(Playing::class);
    expect($gs->map->phase->value)->toBe('warmup');
});

test('parse from object returns Playing (freezetime)', function () {
    $obj = json_decode(file_get_contents(__DIR__ . '/../Fixtures/freezetime.json'));

    $gs = GSIParser::parse($obj);

    expect($gs)->toBeInstanceOf(Playing::class);
    expect($gs->round->phase->value)->toBe('freezetime');
    expect($gs->player->activity->value)->toBe('textinput');
});

test('parse live bomb payload returns Playing with planted bomb', function () {
    $obj = json_decode(file_get_contents(__DIR__ . '/../Fixtures/live_bomb.json'));

    $gs = GSIParser::parse($obj);

    expect($gs)->toBeInstanceOf(Playing::class);
    expect($gs->round->bomb->value)->toBe('planted');
    expect($gs->added)->not->toBeNull();
});

// New test to exercise Spectating and many types
test('parse spectating payload returns Spectating and populates complex types', function () {
    $obj = json_decode(file_get_contents(__DIR__ . '/../Fixtures/spectating_full.json'));

    $gs = GSIParser::parse($obj);

    expect($gs)->toBeInstanceOf(Spectating::class);

    // map
    expect($gs->map->name)->toBe('de_inferno');
    expect($gs->map->current_spectators)->toBe(5);

    // round and bomb
    expect($gs->round->phase->value)->toBe('live');
    expect($gs->round->bomb->value)->toBe('planted');
    expect($gs->bomb->state->value)->toBe('planted');
    expect($gs->bomb->position)->toBe('50 60 70');

    // allplayers
    expect(is_array($gs->allplayers))->toBeTrue();
    $keys = array_keys((array) $gs->allplayers);
    expect(count($keys))->toBeGreaterThanOrEqual(2);

    // check a specific player
    $playerOne = $gs->allplayers['76561198000000001'];
    expect($playerOne->name)->toBe('PlayerOne');
    expect($playerOne->state->health)->toBe(100);
    // weapon name is an enum; assert its backing value
    expect($playerOne->weapons['weapon_0']->name->value)->toBe('weapon_ak47');

    // grenades
    expect(is_array($gs->grenades))->toBeTrue();
    $grenade = $gs->grenades['grenade_0'];
    // grenade name is an enum; assert case name or backing value
    expect($grenade->name->name)->toBe('FRAG');

    // previously
    expect($gs->previously->map->phase->value)->toBe('warmup');
    expect($gs->previously->player->activity->value)->toBe('playing');

    // auth
    expect($gs->auth->token)->toBe('SPECTOKEN');
});
