<?php

namespace Kgalanos\User\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kgalanos\User\User
 */
class User extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Kgalanos\User\User::class;
    }
}
