<?php

namespace Aiur18\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Aiur18\Question\Comment;
use Aiur18\Filter\MyTextFilter;

/**
 * Form to create an item.
 */
class CreateComment extends FormModel
{
    public $idForQuestion;
    public $idForAnswer;

    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $idAnswer, $idQuestion)
    {
        parent::__construct($di);
        $this->idForAnswer = $idAnswer;
        $this->idForQuestion = $idQuestion;
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Details of the item",
            ],
            [

                "comment" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],


                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /** Method
     */
    public function callbackSubmit() : bool
    {
        $answer = new Comment();
        $answer->setDb($this->di->get("dbqb"));

        //Markdown filter applied
        $filterMarkdown = new \Aiur18\Filter\MyTextFilter();
        $commentRes = $filterMarkdown->markdown($this->form->value("comment"));

        $answer->user_id  = $_SESSION['user_id'];
        $answer->comment = $commentRes;
        $answer->id_answer = $this->idForAnswer;
        $answer->id_question = $this->idForQuestion;
        $answer->save();
        return true;
    }

    /** Method
     */
    public function getItemDetails($id) : object
    {
        $answer = new Comment();
        $answer->setDb($this->di->get("dbqb"));
        $answer->find("id", $id);
        return $answer;
    }


    /**
     * Method
     */
    public function setId($id) : bool
    {
        $this->id = $id;
        return true;
    }


    /**
     * Method
     */
    public function getId() : int
    {
        return $this->id;
    }



    /** Method
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("question")->send();
    }
}
