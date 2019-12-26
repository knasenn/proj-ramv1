<?php

namespace Aiur18\getset;



/**
 * A database driven model using the Active Record design pattern.
 */
class getset
{


    /** Method
     */
    function getGet($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
    }


    /** Method
     */
    function setGet($key, $value)
    {
        if ($key != null && $value != null) {
            $_GET[$key] = $value;
        }
    }


    /** Method
     */
    function getPost($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
    }


    /** Method
     */
    function setPost($key, $value)
    {
        if ($key != null && $value != null) {
            $_POST[$key] = $value;
        }
    }

    /** Method
     */
    function getServer($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }


    /** Method
     */
    function setServer($key, $value)
    {
        if ($key != null && $value != null) {
            $_SESSION[$key] = $value;
        }
    }

      /**
     * Method
     */
    public function logoutSession()
    {
        session_destroy();
        session_start();
    }

}
