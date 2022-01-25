<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

$this->title = Yii::$app->getUser()->identity->username;
?>
<div class="site-index">
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Create Post',
                'url' => ['post/create'],
            ],
            [
                'label' => 'Profile',
                'url' => ['user/index'],
            ],
        ],
        'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
    ]);
    ?>
</div>
<?if(!empty($posts)):?>
    <?= $this->render('/post/posts', [
        'posts' => $posts,
        'pages' => $pages,
    ]) ?>
<?endif;?>
