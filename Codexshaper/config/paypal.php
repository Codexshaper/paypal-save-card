<?php

return [

    /*
    |-------------------------------------------------------------
    | Client ID
    |-------------------------------------------------------------
    |
    | Your App client id
    |
     */

    'client_id'     => 'AXJEwzJFkHSr7y1otjv-NKSbkZRyRqEBqeu0-zEhJVLlltA1URZo2yIAQAUZxgjBzHn80JtnSINXQ884',

    /*
    |-------------------------------------------------------------
    | Client Secret
    |-------------------------------------------------------------
    |
    | Your App client secret
    |
     */

    'client_secret' => 'EIMxQN6wg5-al0ZeslpIHbQbC6S2dZP243wVFnNWeMMA5T0a0OP5yW68Jtyd8u4eg_YHlMhEO9D9dUM-',

    /*
    |-------------------------------------------------------------
    | Mode
    |-------------------------------------------------------------
    |
    | Set this option 'live' for production and 'sandbox' for Development
    |
     */

    "mode"          => "sandbox",
    /*
    |-------------------------------------------------------------
    | Log
    |-------------------------------------------------------------
    |
    | Debug your log and save the specified file
    |
     */
    "log"           => [
        "LogEnabled" => true,
        "FileName"   => "Paypal.log",
        "LogLevel"   => "DEBUG",
    ],
];
