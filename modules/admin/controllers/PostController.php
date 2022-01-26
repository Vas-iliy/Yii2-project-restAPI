<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Image;
use app\modules\admin\models\Post;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends AppAdminController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $posts = Post::find()->with('images');
        $pages = new Pagination(['totalCount' => $posts->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $posts = $posts->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('posts', 'pages'));
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();
        $imgs = new Image();

        if ($this->request->isPost) {
            $this->createPost($model, $imgs);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function createPost($model, $imgs)
    {
        $model->user_id = \Yii::$app->getUser()->id;
        $model->load($this->request->post());
        if ($model->validate()) {
            Image::deleteImages($model);
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if (!$model->save() || !$imgs->CreateImages($model->imgs, $model->id)) {
                \Yii::$app->session->setFlash('error', 'Ошибка создания страницы');
                $transaction->rollBack();
            } else {
                $transaction->commit();
                \Yii::$app->session->setFlash('success', 'Страница создана');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imgs = new Image();

        if ($model->user_id !== \Yii::$app->getUser()->id){
            throw new NotFoundHttpException('У вас нет прав доступа на редактирование этой страницы');
        }

        if ($this->request->isPost) {
            $this->createPost($model, $imgs);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id !== \Yii::$app->getUser()->id){
            throw new NotFoundHttpException('У вас нет прав доступа на удаление этой страницы');
        }
        Image::deleteImages($model);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
