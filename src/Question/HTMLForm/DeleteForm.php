<?php

namespace Aiur18\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Aiur18\Question\Question;

/**
 * Form to delete an item.
 */
class DeleteForm extends FormModel
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
                "legend" => "Delete an item",
            ],
            [
                "select" => [
                    "type"        => "select",
                    "label"       => "Select item to delete:",
                    "options"     => $this->getAllItems(),
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Delete item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /** Method
     */
    protected function getAllItems() : array
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $questions = ["-1" => "Select an item..."];
        foreach ($question->findAll() as $obj) {
            $questions[$obj->id] = "{$obj->column1} ({$obj->id})";
        }

        return $questions;
    }



    /** Method
     */
    public function callbackSubmit() : bool
    {
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->find("id", $this->form->value("select"));
        $question->delete();
        return true;
    }



    /** Method
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("question")->send();
    }
}
