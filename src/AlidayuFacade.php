<?php

namespace iscms\Alidayu;
use Illuminate\Support\Facades\Facade;

class AlidayuFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'alidayu';
    }
}