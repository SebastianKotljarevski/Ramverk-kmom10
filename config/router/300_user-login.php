<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "User Controller",
            "mount" => "login",
            "handler" => "\Anax\User\UserController",
        ],
    ]
];
