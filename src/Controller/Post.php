<?php

namespace Anax\Controller;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Post extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Posts";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $postId;
    public $rubrik;
    public $text;
    public $taggar;

    /**
     * Set the password.
     *
     * @param string $password the password to use.
     *
     * @return void
     */
}
