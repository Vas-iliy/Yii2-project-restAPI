<?php


namespace app\modules\admin\controllers;


use app\modules\admin\models\Post;
use app\modules\admin\models\User;
use yii\data\Pagination;

class UserController extends AppAdminController
{
    public function actionIndex()
    {
        $users = User::find()->select(['username', 'email', 'id'])->all();
        return $this->render('index', compact('users'));
    }

    public function actionView($id)
    {
        if ($id == \Yii::$app->user->id) {
            return $this->redirect('/project-restAPI/admin');
        }
        $posts = Post::find()->where(['user_id' => $id])->with('images');
        $pages = new Pagination(['totalCount' => $posts->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $posts = $posts->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('view', compact('posts', 'pages'));
    }
}