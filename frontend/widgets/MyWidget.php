<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 25.12.2018
 * Time: 12:27
 */

namespace frontend\widgets;
use common\models\tables\Tasks;
use yii\base\Widget;


class MyWidget extends Widget
{
    public $model;

    public function run(){

        if (is_a($this->model, Tasks::class)){
            return $this->render('tasks', ['model' => $this->model]);
        }
        throw  new \Exception("Невозможно отобразить модель!!");


/*        $tasks = \Yii::$app->db->createCommand("
        SELECT `name`, `description`, id, `date` FROM tasks WHERE id = {$this->title}"
        )->queryAll();

        foreach ($tasks as $task){
            return $this->render('tasks', ['data' => $task]);
        }*/
    }
}