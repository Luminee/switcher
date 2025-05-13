<?php

namespace Luminee\Switcher\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed run(Closure $command, string $connection)
 */
class Switcher extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'switcher';
    }
}