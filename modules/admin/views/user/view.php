<?$this->title = 'User';

if(!empty($posts)):?>
    <?= $this->render('/post/posts', [
        'posts' => $posts,
        'pages' => $pages,
    ]) ?>
<?endif;?>