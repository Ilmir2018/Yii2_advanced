<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 18.12.2018
 * Time: 11:38
 */

namespace frontend\controllers;

use common\models\forms\TaskAttachmentsAddForm;
use common\models\tables\TaskComments;
use common\models\tables\Tasks;
use common\models\tables\TaskStatuses;
use common\models\tables\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;


class TaskController extends Controller
{

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionOne($id){

//        if(!\Yii::$app->user->can('TaskDelete')) {
//            throw new ForbiddenHttpException();
//        }
        if (\Yii::$app->user->can('CommentAdd') && \Yii::$app->user->can('FileAdd')) {
            return $this->render('one', [
                'model' => Tasks::findOne($id),
                'usersList' => Users::getUsersList(),
                'statusesList' => TaskStatuses::getList(),
                'userId' => \Yii::$app->user->id,
                'taskCommentForm' => new TaskComments(),
                'taskAttachmentForm' => new TaskAttachmentsAddForm(),]);
        }else{
            return $this->render('two', [
                'model' => Tasks::findOne($id),
                'usersList' => Users::getUsersList(),
                'statusesList' => TaskStatuses::getList(),
                'userId' => \Yii::$app->user->id]);
        }
    }

    public function actionSave($id)
    {
        if ($model = Tasks::findOne($id)){
            $model->load(\Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', 'Изменения сохранены');
        }else{
            \Yii::$app->session->setFlash('error', 'Не удалось сохранить изменения');
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionAddComment()
    {
        $model = new TaskComments();
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            \Yii::$app->session->setFlash('success', "Комментарий добавлен");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }
        $this->redirect(\Yii::$app->request->referrer);

    }


    public function actionAddAttachment()
    {
        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->file = UploadedFile::getInstance($model, 'file');
        if($model->save()){
            \Yii::$app->session->setFlash('success', "Файл добавлен");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

}