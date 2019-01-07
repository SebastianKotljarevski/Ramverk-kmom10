<?php

namespace Anax\Controller\HTMLForm;

use Anax\Controller\Comment;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\User\User;

/**
 * Example of FormModel implementation.
 */
class CreatePostForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Skapa inlägg",
            ],
            [
                "rubrik" => [
                    "type"        => "text",
                ],

                "text" => [
                    "type"        => "text",
                ],

                "taggar" => [
                    "type"        => "text",
                ],


                "submit" => [
                    "type" => "submit",
                    "value" => "Skapa inlägg",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
     public function callbackSubmit()
    {
        // Get values from the submitted form
        $rubrik       = $this->form->value("rubrik");
        $text         = $this->form->value("text");
        $taggar      = $this->form->value("taggar");
        $user_id     = $_SESSION['userpost_id'];

        // Save to database
        $db = $this->di->get("dbqb");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $db->connect()
           ->insert("Posts", ["userId", "rubrik", "text", "taggar"])
           ->execute([$user_id, $rubrik, $text, $taggar]);

        $this->form->addOutput("Inlägg skapat");
        return true;
    }
}
