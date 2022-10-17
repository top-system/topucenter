<?php

namespace TopSystem\UCenter\Facades;

use Illuminate\Support\Facades\Facade;

class UCenter extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \TopSystem\UCenter\UCenter::class;
    }
}