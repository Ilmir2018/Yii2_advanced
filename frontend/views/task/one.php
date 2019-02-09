<?php
/**@var \common\models\tables\Tasks $model */
/**@var integer $userId */
/**@var \common\models\tables\TaskStatuses[] $statusesList */
/**@var \common\models\tables\Users[] $usersList */
/**@var \common\models\tables\TaskComments $taskCommentForm */
/**@var \common\models\tables\TaskAttachments $taskAttachmentForm */
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

//\app\assets\TaskOneAsset::register($this);
?>

<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id' => $model->id])]);?>
        <?=$form->field($model, 'name')->textInput();?>
        <div class="row">
            <div class="col-lg-4">
                <?=$form->field($model, 'status')
                    ->dropDownList($statusesList)?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'responsible_id')
                    ->dropDownList($usersList)?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'date')
//                ->widget(\yii\jui\DatePicker::class, [
//                        'language' => 'ru'
//                ])
                   ->textInput(['type' => 'date'])
                ?>
            </div>
        </div>
        <div>
            <?=$form->field($model, 'description')
                ->textarea()?>
        </div>
        <?=Html::submitButton("Сохранить",['class' => 'btn btn-success']);?>
        <?ActiveForm::end()?>
        <button id="push-me-btn" class="btn btn-success">Push me!</button>
    </div>
</div>
<div class="attachments">
    <h3>Вложения</h3>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['task/add-attachment']),
        'options' => ['class' => "form-inline"]
    ]);?>
    <?=$form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false);?>
    <?=$form->field($taskAttachmentForm, 'file')->fileInput();?>
    <?=Html::submitButton("Добавить",['class' => 'btn btn-default']);?>
    <?ActiveForm::end()?>
    <hr>
    <div class="attachments-history">
        <?foreach ($model->taskAttachments as $file): ?>
            <a href="/img/tasks/<?=$file->path?>">
                <img src="/img/tasks/small/<?=$file->path?>" alt="">
            </a>
        <?php endforeach;?>
    </div>
    <div class="task-history">
        <div class="comments">
            <h3>Комментарии</h3>
            <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]);?>
            <?=$form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false);?>
            <?=$form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false);?>
            <?=$form->field($taskCommentForm, 'content')->textInput();?>
            <?=Html::submitButton("Добавить",['class' => 'btn btn-default']);?>
            <?ActiveForm::end()?>
            <hr>
            <div class="comment-history">
                <?foreach ($model->taskComments as $comment): ?>
                    <p><strong><?=$comment->user->login?></strong>: <?=$comment->content?></p>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
