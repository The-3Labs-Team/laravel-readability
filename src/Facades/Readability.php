<?php

namespace The3LabsTeam\Readability\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \The3LabsTeam\Readability\Readability
 */
class Readability extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \The3LabsTeam\Readability\Readability::class;
    }
}
