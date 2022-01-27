<?php

namespace app\modules\rest\controllers;

use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = 'app\modules\admin\models\Post';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }
}