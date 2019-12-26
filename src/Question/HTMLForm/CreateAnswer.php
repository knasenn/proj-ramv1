<?php

namespace Aiur18\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Aiur18\Question\Answer;
use Aiur18\getset\getset;

/**
 * Form to create an item.
 */
class CreateAnswer extends FormModel
{
    public $idForQuestion;

    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $this->idForQuestion = $id;
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Details of the item",
            ],
            [

                "answer" => [
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


        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        //Markdown filter applied
        $filterMarkdown = new \Aiur18\Filter\MyTextFilter();
        $answerRes = $filterMarkdown->markdown($this->form->value("answer"));

        $getServer = new getSet();
        $answer->user_id  = $getServer->getServer('user_id');
        $answer->answer = $answerRes;
        $answer->id_question = $this->idForQuestion;
        $answer->save();
        return true;
    }

    /** Method
     */
    public function getItemDetails($id) : object
    {
        $answer = new Answer();
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
