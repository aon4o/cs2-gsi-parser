<?php

declare(strict_types=1);

beforeEach()->group('arch', 'architecture', 'presets');

arch()->preset()->security();

arch()->preset()->php();
