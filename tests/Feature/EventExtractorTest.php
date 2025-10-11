<?php

declare(strict_types=1);

use Aon4o\Cs2GsiParser\Enums\Custom\Event;
use Aon4o\Cs2GsiParser\EventExtractor;
use Aon4o\Cs2GsiParser\GameState;

beforeEach()->group('extractor');

test('mapEvents detects map phase change between warmup and freezetime', function () {
    $previous = GameState::from(loadFixture('warmup'));
    $current = GameState::from(loadFixture('freezetime'));

    $extractor = new EventExtractor($previous, $current);

    expect($extractor->mapEvents())->toContain(Event::MAP_PHASE_CHANGED);
});

test('playerEvents detects player activity and player state changes', function () {
    $previous = GameState::from(loadFixture('warmup'));
    $current = GameState::from(loadFixture('freezetime'));

    $extractor = new EventExtractor($previous, $current);

    expect($extractor->playerEvents())->toContain(Event::PLAYER_ACTIVITY_CHANGED)
        ->and($extractor->playerEvents())->toContain(Event::PLAYER_HP_CHANGED);
});

test('roundEvents detects round phase change', function () {
    $previous = GameState::from(loadFixture('warmup'));
    $current = GameState::from(loadFixture('freezetime'));

    $extractor = new EventExtractor($previous, $current);

    expect($extractor->roundEvents())->toContain(Event::ROUND_PHASE_CHANGED);
});

test('allEvents merges events from map, player and round differs', function () {
    $previous = GameState::from(loadFixture('warmup'));
    $current = GameState::from(loadFixture('freezetime'));

    $extractor = new EventExtractor($previous, $current);

    $all = $extractor->allEvents();

    expect($all)->toContain(Event::MAP_PHASE_CHANGED)
        ->and($all)->toContain(Event::ROUND_PHASE_CHANGED)
        ->and($all)->toContain(Event::PLAYER_HP_CHANGED);
});

test('no events when comparing identical states', function () {
    $gs = GameState::from(loadFixture('freezetime'));

    $extractor = new EventExtractor($gs, $gs);

    expect($extractor->allEvents())->toBeEmpty();
});
