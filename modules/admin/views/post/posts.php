<div class="container-fluid">
    <div class="row">
        <? use yii\helpers\Html;
        use yii\helpers\Url;

        foreach ($posts as $post):?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?$i = 1; foreach ($post->images as $image):?>
                                    <div class="carousel-item <?=$i == 1 ? 'active' : ''?>">
                                        <?=Html::img("@web/{$image->title}", ['class' => 'card-img-top', 'height' => 250]) ?>
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
                        <a href="<?=Url::to(['post/view', 'id' => $post->id])?>" class="btn btn-primary">Go somewhere</a>
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