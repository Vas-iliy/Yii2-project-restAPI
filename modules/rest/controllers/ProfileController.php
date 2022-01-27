<?php

namespace app\modules\rest\controllers;

use app\models\User;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class ProfileController extends Controller
{
    public function behaviors()
    {
        $behaviors  = parent::behaviors();
        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::class,
            HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        return User::findOne(\Yii::$app->user->id);
    }

    public function verbs()
    {
        return [
            'index' => ['get']
        ];
    }
}