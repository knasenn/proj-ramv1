<?php

namespace Aiur18\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Aiur18\User\User;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
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
        $question = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $question->id,
                ],

                "acronym" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $question->acronym,
                ],

                "firstname" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $question->firstname,
                ],

                "lastname" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $question->lastname,
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
   * Method 
   */
    public function getItemDetails($id) : object
    {
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $id);
        return $user;
    }



    /**
   * Method
   */
    public function callbackSubmit() : bool
    {
        $question = new User();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $this->form->value("id"));
        $question->acronym = $this->form->value("acronym");
        $question->firstname = $this->form->value("firstname");
        $question->lastname = $this->form->value("lastname");
        $question->save();
        return true;
    }
}
