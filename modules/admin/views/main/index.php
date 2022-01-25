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
<div class="container-fluid">
    <div class="row">
        <?foreach ($posts as $post):?>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?$i = 1; foreach ($post->images as $image):?>
                            <div class="carousel-item <?=$i == 1 ? 'active' : ''?>">
                                <?=Html::img("@web/{$image->title}", ['class' => 'card-img-top', 'height' => 200]) ?>
                            </div>
                            <?$i++; endforeach;?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$post->title?></h5>
                    <p class="card-text"><?=$post->text?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <?endforeach;?>
        <div class="clearfix"> </div>
        <div class="col-lg-12">
            <?=\yii\widgets\LinkPager::widget([
                'pagination' => $pages,
                'maxButtonCount' => 3,
                'pageCssClass' => 'page-item',
                'linkOptions' => ['class' => 'page-link']
            ])?>
        </div>
    </div>
</div>
<?endif;?>
