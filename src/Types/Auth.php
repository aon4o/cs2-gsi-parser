<?php

declare(strict_types=1);

namespace Aon4o\Cs2GsiParser\Types;

use Aon4o\Cs2GsiParser\Traits\ParserConstructor;

class Auth
{
    use ParserConstructor;

    public string|null $token = null;
}
