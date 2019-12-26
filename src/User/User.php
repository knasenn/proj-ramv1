<?php

namespace Aiur18\User;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class User extends ActiveRecordModel
{
      /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "User";

    /** Variables
     */
    public $id;
    public $acronym;
    public $password;
    public $firstname;
    public $lastname;
    public $created;
    public $updated;
    public $deleted;
    public $active;

    /** Method
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /** Method
     */
    public function verifyPassword($acronym, $password)
    {
        $this->find("acronym", $acronym);
        return password_verify($password, $this->password);
    }


      /**
     * Method
     */
    public function setSession($id)
    {
        $_SESSION['user_id'] = $id;
    }

      /**
     * Method
     */
    public function getSession()
    {
        return $_SESSION['user_id'];
    }

      /**
     * Method
     */
    public function logoutSession()
    {
        session_destroy();
        session_start();
    }


      /**
     * Method
     */
    public function checkAvatar($avatar)
    {
        if ($avatar == null || $avatar == "") {
            return "..\img\placeholder-avatar.jpg";
        } else {
            return $avatar;
        }
    }
}
