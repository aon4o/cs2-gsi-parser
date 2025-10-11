<?php

declare(strict_types=1);

use Aon4o\Cs2GsiParser\GSIConfigWriter;

beforeEach()->group('writer');

test('defaults', function () {
    $writer = new GSIConfigWriter();

    expect($writer->url)->toBe('http://localhost:8000')
        ->and($writer->auth_token)->toBe('')
        ->and($writer->name)->toBe('cs2-gsi')
        ->and(array_key_exists('timeout', $writer->settings))->toBeTrue()
        ->and($writer->settings['timeout'])->toBe(5.0)
        ->and(array_key_exists('map', $writer->data))->toBeTrue()
        ->and($writer->data['map'])->toBeTrue();

});

test('fluent setters and text contains values', function () {
    $w = GSIConfigWriter::new();
    $ret = $w->setUrl('http://example.test');

    expect($ret)->toBe($w);

    $w->setAuthToken('secret')->setName('my-name');

    $text = $w->get();

    expect($text)->toContain('"uri" "http://example.test"')
        ->and($text)->toContain('"token" "secret"')
        ->and($text)->toContain('"my-name"');
});

test('setSettings reflects in text', function () {
    $w = new GSIConfigWriter();
    $w->setSettings(2.5, 0.25, 0.75, 12.5);

    $text = $w->get();

    expect($text)->toContain('"timeout" "2.5"')
        ->and($text)->toContain('"buffer"')
        ->and($text)->toMatch('/"buffer"\s+"0\.25"/')
        ->and($text)->toContain('"throttle" "0.75"')
        ->and($text)->toContain('"heartbeat" "12.5"');
});

test('setData reflects flags in text', function () {
    $w = new GSIConfigWriter();

    // setData signature requires 17 booleans; supply a mix
    $w->setData(
        false, // map_round_wins
        true,  // map
        false, // player_id
        false, // player_match_stats
        false, // player_state
        false, // player_weapons
        true,  // provider
        false, // round
        false, // allgrenades
        false, // allplayers_id
        false, // allplayers_match_stats
        false, // allplayers_position
        false, // allplayers_state
        false, // allplayers_weapons
        false, // bomb
        false, // phase_countdowns
        true,   // player_position
    );

    $text = $w->get();

    expect($text)->toContain('"map_round_wins" "0"')
        ->and($text)->toContain('"map" "1"')
        ->and($text)->toContain('"provider" "1"')
        ->and($text)->toContain('"player_position" "1"');

    foreach (array_keys($w->data) as $key) {
        $pattern = '/' . preg_quote('"' . $key . '"', '/') . '\s*"[01]"/';
        expect($text)->toMatch($pattern);
    }
});
