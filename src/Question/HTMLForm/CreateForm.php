<?php

namespace Aiur18\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Aiur18\Question\Question;
use Aiur18\Filter\MyTextFilter;

/**
 * Form to create an item.
 */
class CreateForm extends FormModel
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
                "legend" => "Details of the item",
            ],
            [
                "subject" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "question" => [
                    "type" => "textarea",
                    "validation" => ["not_empty"],
                ],

                "facebook" => [
                    "type"        => "checkbox",
                ],

                "youtube" => [
                    "type"        => "checkbox",
                ],

                "twitter" => [
                    "type"        => "checkbox",
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
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        //Markdown filter applied
        $filterMarkdown = new \Aiur18\Filter\MyTextFilter();
        $subjectRes = $filterMarkdown->markdown($this->form->value("subject"));
        $questionRes = $filterMarkdown->markdown($this->form->value("question"));

        $question->user_id  = $_SESSION['user_id'];
        $question->subject  = $subjectRes;
        $question->question = $questionRes;
        $question->facebook = $this->form->value("facebook");
        $question->youtube = $this->form->value("youtube");
        $question->twitter = $this->form->value("twitter");
        $question->save();
        return true;
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
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("question")->send();
    }
}
