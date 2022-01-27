<?php

namespace app\modules\rest\controllers;

use app\modules\rest\models\LoginForm;
use yii\rest\Controller;

class AuthController extends Controller
{
    public function actionIndex()
    {
        return 'rest';
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load($this->request->bodyParams, '');
        if ($token = $model->auth()) return $token;
        return $model;
    }

    protected function verbs()
    {
        return [
            'login' => ['post'],
        ];
    }
}