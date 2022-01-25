<?$this->title = 'Users';
?>
<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">E-mail</th>
        <th scope="col">Posts</th>
    </tr>
    </thead>
    <tbody>
    <?$i=1; foreach ($users as $user):?>
    <tr>
        <th scope="row"><?=$i?></th>
        <td><a href="<?=\yii\helpers\Url::to(['user/view', 'id' => $user->id])?>"><?=$user->username?></a></td>
        <td><?=$user->email?></td>
        <td><?=$user->getPosts()->count()?></td>
    </tr>
    <?$i++; endforeach;?>
    </tbody>
</table>