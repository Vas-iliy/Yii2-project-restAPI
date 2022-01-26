<?php

namespace app\modules\api\controllers;

use app\modules\api\models\News;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

class NewController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'only' => [
                'setnews'
            ],
            'tokenParam' => 'key'
        ];
        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'setnews' => ['post']
        ];
    }

    public function actionSetnews()
    {
        $new = new News();
        $new->load($this->request->bodyParams, '');
        if ($new->validate() && $new->save()) {
            return 1;
        }
        return $new;
    }
}