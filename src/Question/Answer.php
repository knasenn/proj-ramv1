<?php

namespace Aiur18\Question;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Answer extends ActiveRecordModel
{
    /** 
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Answer";



    /** Variables
     */
    public $id;
    public $answer;
    public $user_id;
}
