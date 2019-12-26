<?php

namespace Aiur18\Question;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model using the Active Record design pattern.
 */
class Comment extends ActiveRecordModel
{
    /** 
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Comment";



    /** variable
     */
    public $id;
    public $comment;
    public $user_id;

    /** Method
     */
    public function findAllWhereDouble($where, $value)
    {
        $this->checkDb();
        $params = is_array($value) ? $value : [$value];
        return $this->db->connect()
                        ->select()
                        ->from($this->tableName)
                        ->where($where)
                        ->execute($params)
                        ->fetchAllClass(get_class($this));
    }
}
