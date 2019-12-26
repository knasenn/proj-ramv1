<?php

namespace Aiur18\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Aiur18\User\HTMLForm\UserLoginForm;
use Aiur18\User\HTMLForm\CreateUserForm;
use Aiur18\User\HTMLForm\UpdateForm;
use Aiur18\Question\Question;
use Aiur18\Question\Comment;
use Aiur18\getset\getset;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /** Method
     */
    public function listActionGet() : object
    {
        $getServer = new getSet();
        if ($getServer->getServer('user_id') != null) {
            $page = $this->di->get("page");
            $user = new User();
            $user->setDb($this->di->get("dbqb"));

            $page->add("user/view-all", [
                "items" => $user->findAll(),
            ]);

            return $page->render([
                "title" => "A collection of usersYO",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }

    /** Method
     */
    public function infoActionGet($id) : object
    {
        $getServer = new getSet();
        if ($getServer->getServer('user_id') != null) {
            $page = $this->di->get("page");
            $user = new User();
            $user->setDb($this->di->get("dbqb"));



            $questions = new Question();
            $questions->setDb($this->di->get("dbqb"));

            $comments = new Comment();
            $comments->setDb($this->di->get("dbqb"));

            $page->add("user/info", [
                "items" => $user->findAll(),
                "questions" => $questions->findAllWhere("user_id = ?", $id),
                "comments" => $comments->findAllWhere("user_id = ?", $id),
            ]);

            return $page->render([
                "title" => "A collection of users",
            ]);
        } else {
            $this->di->get("response")->redirect("user/login")->send();
        }
    }

    /** Method
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $getServer = new getSet();
        if ($getServer->getServer('user_id') != null) {
            $this->di->get("response")->redirect("user/update")->send();
        } else {
            $getServer->logoutSession();
            $form = new UserLoginForm($this->di);
            $form->check();
            $content = $form->getHTML();
            $login = "<h4>Dont have an account? <a href='create'>Get started</a></h4>";
        }

        $page->add("user/login", [
            "content" => $content,
            "login" => $login,
        ]);


        return $page->render([
            "title" => "A login page2",
        ]);
    }

    /** Method
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("user/user", [
            "content" => $form->getHTML(),
            "login" => ""
        ]);

        return $page->render([
            "title" => "A create user page2",
        ]);
    }


    /** Method
     */
    public function updateAction() : object
    {
        $getServer = new getSet();
        $id = $getServer->getServer('user_id');
        $page = $this->di->get("page");

        $form = new UpdateForm($this->di, $id);
        $form->check();

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $userInfo = $user->findAllWhere("id = ?", $id);
        $avatar = $user->checkAvatar($userInfo[0]->avatar_image);

        $page->add("user/update", [
            "form" => $form->getHTML(),
            "avatar" => $avatar,
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    /** Method
     */
    public function logoutActionGet() : object
    {
        $page = $this->di->get("page");

        //temp
        $user = new User();
        $user->logoutSession();
        $this->di->get("response")->redirect("user/login")->send();
    }
}
