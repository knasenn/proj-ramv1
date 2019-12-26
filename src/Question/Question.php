<?php

namespace Aiur18\Question;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Question extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Question";



    /** variables
     */
    public $id;
    public $subject;
    public $question;
    public $facebook;
    public $youtube;
    public $twitter;
    public $user_id;


      /**
     * Method
     */
    public function getLastThree($obj)
    {
        $array = array();
        foreach ($obj as $key => $value) {
            array_push($array, $value);
        }
        return array_slice($array, -3, 3, true);
    }



      /**
     * Method
     */
    public function getMostTags($obj)
    {
        $facebook = 0;
        $youtube = 0;
        $twitter = 0;
        foreach ($obj as $key => $value) {
            if ($value->facebook) {
                $facebook++;
            }
            if ($value->youtube) {
                $youtube++;
            }
            if ($value->twitter) {
                $twitter++;
            }
        }
        $arr = ["facebook" => $facebook, "youtube" => $youtube, "twitter" => $twitter];
        return array_keys($arr, max($arr));
    }


      /**
     * Method
     */
    public function getMostActive($questions, $answers, $comments)
    {
        $array = array();
        foreach ($questions as $value) {
            if ($value->user_id != null) {
                if (array_key_exists($value->user_id, $array)) {
                    $array[$value->user_id]++;
                } else {
                    $array[$value->user_id] = 1;
                }
            }
        }

        foreach ($answers as $value) {
            if ($value->user_id != null) {
                if (array_key_exists($value->user_id, $array)) {
                    $array[$value->user_id]++;
                } else {
                    // $tempArray = array();
                    // $tempArray = array($value->user_id => 1);
                    $array[$value->user_id] = 1;
                }
            }
        }

        foreach ($comments as $value) {
            if ($value->user_id != null) {
                if (array_key_exists($value->user_id, $array)) {
                    $array[$value->user_id]++;
                } else {
                    // $tempArray = array();
                    // $tempArray = array($value->user_id => 1);
                    $array[$value->user_id] = 1;
                }
            }
        }
        $value = max($array);
        $key = array_search($value, $array);

        return $key;
    }
}
