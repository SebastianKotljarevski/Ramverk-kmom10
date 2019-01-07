<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "home",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Logga in",
            "url" => "login",
            "title" => "Logga in.",
        ],
        [
            "text" => "Skapa konto",
            "url" => "login/create",
            "title" => "Skapa konto",
        ],
        [
            "text" => "Skapa inlägg",
            "url" => "createpost",
            "title" => "Skapa inlägg",
        ],
        [
            "text" => "Min profil",
            "url" => "profile",
            "title" => "Min profil",
        ],
    ],
];
