<?php


namespace TaylorNetwork\Multiplexer\Contracts;


interface MultiplexerContract
{
    /**
     * Get the multiplexer command to run for the specified action
     *
     * @param string  $action
     * @return string
     */
    public function command(string $action): string;

    /**
     * Get the multiplexer command
     *
     * @return string
     */
    public function baseCommand(): string;

    /**
     * Create a new session
     *
     * @param string  $name
     * @param string  $command
     * @return string
     */
    public function init(string $name, string $command): string;

    /**
     * Attach to a named session
     *
     * @param string  $name
     * @return string
     */
    public function attach(string $name): string;

    /**
     * List all active sessions
     *
     * @return string
     */
    public function sessions(): string;

    /**
     * Kill a named session
     *
     * @param string  $name
     * @return string
     */
    public function kill(string $name): string;

    /**
     * Check if a named session exists
     *
     * @param string  $name
     * @return string
     */
    public function check(string $name): string;

    /**
     * Send a command to the multiplexer
     *
     * @param string  $name
     * @param string  $command
     * @return string
     */
    public function send(string $name, string $command): string;

    /**
     * Capture the screen
     *
     * @param string  $name
     */
    public function capture(string $name);
}
