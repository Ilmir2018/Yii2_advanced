<style>
    .task{
        margin-left: 20px;
        width: 300px;
        background-color: snow;
        padding: 10px 10px 10px 10px;
        border: 1px solid black;
    }
    h1{
        margin-left: 40px;
    }
</style>
<?php use yii\helpers\Html;?>
<div class="task">
<a href="<?= \yii\helpers\Url::to(['task/task', 'id' => $tasks->id])?>">
    <h2><?=$tasks['id']?></h2>
</a>
    <h3><?=$tasks['name']?></h3>
    <p><?=$tasks['description']?></p>
    <p><?=$tasks['date']?><p/>
    <?= Html::input('text', ['class' => 'btn btn-success']) ?>
    <?= Html::input('text', ['class' => 'btn btn-success']) ?>
    <?= Html::input('file', ['class' => 'btn btn-success']) ?>
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
