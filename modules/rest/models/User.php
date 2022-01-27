<?php


namespace app\modules\rest\models;


class User extends \app\models\User
{
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return '';
    }
}