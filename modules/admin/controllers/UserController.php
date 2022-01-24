<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;
}