<?php

namespace Savin\PCNTL\Facades;

use Illuminate\Support\Facades\Facade;

class PCNTL extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'savin.pcntl';
    }
}
