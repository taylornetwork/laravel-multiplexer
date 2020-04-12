<?php


namespace TaylorNetwork\Multiplexer\Drivers;

class Tmux extends Multiplexer
{
    protected $baseCommand = 'tmux';

    protected $commands = [
        'init' => 'new-session -d -s {name} "{command}"',
        'attach' => 'attach -t {name}',
        'sessions' => 'list-sessions',
        'kill' => 'kill-session -t {name}',
        'check' => 'has-session -t {name}',
        'send' => 'send-keys -t {name} "{command}" Enter',
        'capture' => 'capture-pane -t {name} -pS -{lines}',
    ];
}