<?php


namespace app\modules\admin\controllers;


use app\modules\admin\models\Post;
use yii\data\Pagination;

class MainController extends AppAdminController
{
    public function actionIndex()
    {
        $posts = Post::find()->where(['user_id' => \Yii::$app->getUser()->id])->with('images');
        $pages = new Pagination(['totalCount' => $posts->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $posts = $posts->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('posts', 'pages'));
    }
}