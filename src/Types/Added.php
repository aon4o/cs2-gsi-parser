<?php

namespace Aon4o\Cs2GsiParser\Types;

class Added
{
    //   round?: {
    //      bomb?: boolean
    //      win_team?: boolean
    //    }
    //    map?: Map

    public Round|null $round = null; // TODO

    public Map|null $map = null;
}
