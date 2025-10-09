<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Enums\PhaseType;

class Phase
{
    public PhaseType $phase;

    public float $phase_ends_in; // returns float in string format
}
