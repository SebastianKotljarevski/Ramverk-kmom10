<?php

namespace Anax\Controller\HTMLForm;

use Anax\Controller\Comment;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class CreateAnswerForm extends FormModel
{
    public $postId;
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $id)
    {
        $this->postId = $id;
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Svara på inlägg.",
            ],
            [
                "text" => [
                    "type"        => "text",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Skapa svar",
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
        $text         = $this->form->value("text");

        // Save to database
        $db = $this->di->get("dbqb");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $db->connect()
           ->insert("Answers", ["id", "userId", "text"])
           ->execute([$this->postId, $_SESSION['userpost_id'], $text]);

        $this->form->addOutput("La till svar");
        return true;
    }
}
