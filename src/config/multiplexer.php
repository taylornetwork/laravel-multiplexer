<?php

return [

    /*
     * Default multiplexer
     */
    'default' => 'tmux',

    /*
     * Multiplexers and their classes
     */
    'drivers' => [
        'tmux' => \TaylorNetwork\Multiplexer\Drivers\Tmux::class,
    ],

    /*
     * Override commands here.
     *
     * 'commands' => [
     *     'tmux' => [
     *         'init' => 'overridden command',
     *     ],
     * ],
     */
    'commands' => [],

];