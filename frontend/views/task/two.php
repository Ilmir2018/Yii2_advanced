<?php
/**@var \app\models\tables\Tasks $model */
/**@var integer $userId */
/**@var \app\models\tables\TaskStatuses[] $statusesList */
/**@var \app\models\tables\Users[] $usersList */
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