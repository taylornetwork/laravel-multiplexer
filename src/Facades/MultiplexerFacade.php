<?php


namespace TaylorNetwork\Multiplexer\Facades;


use Illuminate\Support\Facades\Facade;

class MultiplexerFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Multiplexer';
    }
}