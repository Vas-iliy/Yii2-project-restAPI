<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Nav;

$this->title = Yii::$app->user->identity->username;
?>
<?if(!empty($posts)):?>
    <?= $this->render('/post/posts', [
        'posts' => $posts,
        'pages' => $pages,
    ]) ?>
<?endif;?>
