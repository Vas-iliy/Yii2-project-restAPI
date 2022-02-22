<?php


namespace app\modules\admin\controllers;


use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;

class AuthController extends AppAdminController
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/project-restAPI');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/project-restAPI');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/project-restAPI');
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/project-restAPI');
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect('/project-restAPI');
        }

        return $this->render('signup', compact('model'));
    }
}