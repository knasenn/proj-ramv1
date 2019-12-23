<?php

namespace Aiur18\Question;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Aiur18\Question\HTMLForm\CreateForm;
use Aiur18\Question\HTMLForm\EditForm;
use Aiur18\Question\HTMLForm\DeleteForm;
use Aiur18\Question\HTMLForm\UpdateForm;
use Aiur18\Question\HTMLForm\CreateAnswer;
use Aiur18\Question\HTMLForm\CreateComment;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /** variables
     */
    public $makaroner;

    /** Method
     */
    public function indexActionGet() : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");
            $question = new Question();
            $question->setDb($this->di->get("dbqb"));

            $page->add("question/crud/view-all", [
                "items" => $question->findAll(),
            ]);

            return $page->render([
                "title" => "A collection of items",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }



    /** Method
     */
    public function createAction() : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");
            $form = new CreateForm($this->di);
            $form->check();

            $page->add("question/crud/create", [
                "form" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "Create a item",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }



    /** Method
     */
    public function deleteAction() : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");
            $form = new DeleteForm($this->di);
            $form->check();

            $page->add("question/crud/delete", [
                "form" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "Delete an item",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }



    /** Method
     */
    public function updateAction(int $id) : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");

            $form = new CreateForm($this->di, $id);
            $form->check();
            $questInfo = $form->getItemDetails($id);

            $answer = new CreateAnswer($this->di, $id);
            $answer->check();


            $answ4quest = new Answer();
            $answ4quest->setDb($this->di->get("dbqb"));

            $com4quest = new Comment();
            $com4quest->setDb($this->di->get("dbqb"));

            // //Fixa så ej session helst
            $_SESSION['id_question'] = $id;

            $page->add("question/crud/createAnswer", [
                "answer" => $answer->getHTML(),
                "questInfo" => $questInfo,
                "items" => $answ4quest->findAllWhere("id_question = ?", $id),
                "itemz" => [
                    "itemz1" => $answ4quest->findAllWhere("id_question = ?", $id),

                    "itemz2" => $com4quest->findAll(),
                ],
            ]);

            return $page->render([
                "title" => "Create a item",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }


    /** Method
     */
    public function commentAction($idAnswer) : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");

            // //Fixa så ej session helst
            $idQuestion = $_SESSION['id_question'];

            $form = new CreateComment($this->di, $idAnswer, $idQuestion);
            $form->check();

            $page->add("question/crud/comment", [
                "form" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "Create a item",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }



    /** Method
     */
    public function commentqAction($idAnswer) : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");

            // //Fixa så ej session helst
            $idQuestion = $_SESSION['id_question'];
            $idAnswer = "question";



            $form = new CreateComment($this->di, $idAnswer, $idQuestion);
            $form->check();

            $page->add("question/crud/comment", [
                "form" => $form->getHTML(),
            ]);

            return $page->render([
                "title" => "Create a item",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }




    /** Method
     */
    public function tagsActionGet() : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");
            $tags = new Question();
            $tags->setDb($this->di->get("dbqb"));

            $page->add("question/crud/all-tags", [
                "items" => $tags->findAll(),
            ]);

            return $page->render([
                "title" => "A collection of tags",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }


    /** Method
     */
    public function spectagActionGet($tag) : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");

            $tagInfo = new Question();
            $tagInfo->setDb($this->di->get("dbqb"));

            // $comments = new Comment();
            // $comments->setDb($this->di->get("dbqb"));

            $page->add("question/crud/info", [
                "tagInfo" => $tagInfo->findAllWhere("{$tag} = ?", 1),
            ]);

            return $page->render([
                "title" => "A collection of users",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }
}
