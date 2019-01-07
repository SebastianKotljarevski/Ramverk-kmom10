<?php

namespace Anax\Profile\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\User\User;

/**
 * Form to update an item.
 */
class UpdateProfileForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Uppdatera profil",
            ],
            [
                "akronym" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->acronym,
                ],

                "email" => [
                    "type" => "text",
                    "validation" => ["email"],
                    "value" => $user->email,
                ],

                "förnamn" => [
                    "type" => "text",
                    "value" => $user->firstname,
                ],

                "efternamn" => [
                    "type" => "text",
                    "value" => $user->lastname,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Book
     */
    public function getItemDetails($id) : object
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $id);
        return $user;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("acronym", $this->form->value("akronym"));
        $user->email = $this->form->value("email");
        $user->firstname = $this->form->value("förnamn");
        $user->lastname = $this->form->value("efternamn");
        $user->save();
        $this->form->addOutput("Ändringar sparade.");
        return true;
    }
}
