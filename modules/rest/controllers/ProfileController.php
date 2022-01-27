<?php

namespace app\modules\rest\controllers;

use app\models\User;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;

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
        return $this->findModel();
    }

    public function actionUpdate()
    {
        $model = $this->findModel();
        $model->load(\Yii::$app->request->getBodyParams(), '');

        if (!$model->save()) {
            throw new ServerErrorHttpException('Fail');
        }
        return $model;
    }

    public function verbs()
    {
        return [
            'index' => ['get'],
            'update' => ['put', 'patch']
        ];
    }

    protected function findModel()
    {
        return User::findOne(\Yii::$app->user->id);
    }
}