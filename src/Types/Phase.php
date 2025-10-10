<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\PhaseType;
use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class Phase
{
    use ParserConstructor;

    public PhaseType $phase;

    public float $phase_ends_in; // returns float in string format
}
