<?php

namespace Aiur18\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Aiur18\Question\Question;
use Aiur18\getset\getset;

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

                "column1" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $question->column1,
                ],

                "column2" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $question->column2,
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



    /** Method
     */
    public function getItemDetails($id) : object
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $id);
        return $question;
    }



    /** Method
     */
    public function callbackSubmit() : bool
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $this->form->value("id"));
        $question->column1 = $this->form->value("column1");
        $question->column2 = $this->form->value("column2");
        $question->save();
        return true;
    }
}
