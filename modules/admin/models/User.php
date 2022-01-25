<?php

namespace app\modules\admin\models;

class User extends \app\models\User
{
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['user_id' => 'id']);
    }
}