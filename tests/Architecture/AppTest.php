<?php

beforeEach()->group('arch', 'architecture');

$base_namespace = 'Aon4o\Cs2GsiParser';

arch('src')
    ->expect($base_namespace)
    ->toUseStrictTypes();

arch('enums')
    ->expect("$base_namespace\Enums")
    ->toBeEnums();
