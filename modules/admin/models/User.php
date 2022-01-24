<?php


namespace app\modules\admin\models;


class User extends \app\models\User
{
    public function fields()
    {
        return ['id', 'username', 'email', 'is_true' => function($model) {return $model->id;}];
    }

    public function extraFields()
    {
        return [];
    }
}