<?php


namespace TaylorNetwork\Multiplexer;

use Illuminate\Support\Facades\Config;
use TaylorNetwork\Multiplexer\Drivers\Multiplexer as BaseMultiplexer;
use TaylorNetwork\Shell\Shell;

class Multiplexer
{
    /**
     * @var BaseMultiplexer
     */
    protected $driver;

    /**
     * Multiplexer constructor.
     *
     * @param string $driver
     */
    public function __construct(string $driver = null)
    {
        if($driver === null) {
            $driver = Config::get('multiplexer.default', 'tmux');
        }

        $driver = Config::get('multiplexer.drivers.'.$driver);

        $this->driver = new $driver;
    }

    /**
     * Pass through to the driver
     *
     * @param string $name
     * @param mixed $arguments
     * @return mixed
     */
    public function __call(string $name, $arguments)
    {
        return Shell::command($this->driver->{$name}(...$arguments));
    }

    /**
     * Pass through to the driver
     *
     * @param string $name
     * @param mixed $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, $arguments)
    {
        return (new static)->{$name}(...$arguments);
    }
}