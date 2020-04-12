<?php


namespace TaylorNetwork\Multiplexer\Drivers;

use Illuminate\Support\Facades\Config;
use TaylorNetwork\Multiplexer\Contracts\MultiplexerContract;

abstract class Multiplexer implements MultiplexerContract
{
    /**
     * The base multiplexer command
     *
     * @var string
     */
    protected $baseCommand;

    /**
     * Map of commands for actions
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Multiplexer constructor.
     */
    public function __construct()
    {
        $this->commands = array_merge($this->commands, Config::get('multiplexer.commands.'.$this->getDriverName()), []);
    }

    /**
     * Get the driver name
     *
     * @return string
     */
    public function getDriverName(): string
    {
        return $this->baseCommand;
    }

    /**
     * @inheritdoc
     */
    public function baseCommand(): string
    {
        return $this->baseCommand;
    }

    /**
     * @inheritdoc
     */
    public function command(string $action): string
    {
        return $this->baseCommand() . ' ' . $this->commands[$action];
    }

    /**
     * @inheritDoc
     */
    public function init(string $name, string $command): string
    {
        return $this->buildCommand('init', compact('name', 'command'));
    }

    /**
     * @inheritDoc
     */
    public function attach(string $name): string
    {
        return $this->buildCommand('attach', compact('name'));
    }

    /**
     * @inheritDoc
     */
    public function sessions(): string
    {
        return $this->buildCommand('sessions');
    }

    /**
     * @inheritDoc
     */
    public function kill(string $name): string
    {
        return $this->buildCommand('kill', compact('name'));
    }

    /**
     * @inheritDoc
     */
    public function check(string $name): string
    {
        return $this->buildCommand('check', compact('name'));
    }

    /**
     * @inheritDoc
     */
    public function send(string $name, string $command): string
    {
        return $this->buildCommand('send', compact('name', 'command'));
    }

    /**
     * @inheritDoc
     */
    public function capture(string $name)
    {
        return $this->buildCommand('capture', compact('name'));
    }


    /**
     * Replace variables in a string
     *
     * @param string  $string
     * @param array  $variables
     * @return string
     */
    public function replace(string $string, array $variables): string
    {
        return preg_replace_callback('/{(.*?)}/', function ($m) use ($variables) {
            return $variables[$m[1]];
        }, $string);
    }

    /**
     * Build the command
     *
     * @param string  $action
     * @param array  $arguments
     * @return string
     */
    public function buildCommand(string $action, array $arguments = [])
    {
        return $this->replace($this->command($action), $arguments);
    }

}