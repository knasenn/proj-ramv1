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
use Aiur18\User\User;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class IndexController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /** Method
     */
    public function indexActionGet() : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");
            $answer = new Answer();
            $answer->setDb($this->di->get("dbqb"));

            $comment = new Comment();
            $comment->setDb($this->di->get("dbqb"));

            $question = new Question();
            $question->setDb($this->di->get("dbqb"));

            $questionItemsLast = $question->getLastThree($question->findAll());
            $questionMostTags = $question->getMostTags($question->findAll());
            $MostActiveUserId = $question->getMostActive(
                $question->findAll(),
                $answer->findAll(),
                $comment->findAll()
            );

            $user = new User();
            $user->setDb($this->di->get("dbqb"));

            $MostActiveUser = $user->findAllWhere("id = ?", $MostActiveUserId);


            $page->add("question/crud/view-last", [
                "last" => $questionItemsLast,
                "tag" => $questionMostTags,
                "user" => $MostActiveUser[0],
            ]);

            return $page->render([
                "title" => "A collection of items!!!!!!",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }

    /** Method
     */
    public function omActionGet() : object
    {
        if (isset($_SESSION['user_id'])) {
            $page = $this->di->get("page");

            $page->add("question/crud/om", [
            ]);

            return $page->render([
                "title" => "About",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }
}
