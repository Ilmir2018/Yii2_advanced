<?php
/**
 * Created by PhpStorm.
 * User: Ilmir
 * Date: 16.01.2019
 * Time: 23:00
 */

namespace frontend\widgets;

use common\models\tables\Tasks;
use common\models\tables\Users;
use yii\base\Widget;

class AdminWidget extends Widget
{

    public $tasks;
    public $users;

    public function run(){

        if (is_a($this->tasks, Tasks::class) || is_a($this->users, Users::class)){
            return $this->render('admin', ['tasks' => $this->tasks, 'users' => $this->users]);
        }
        throw  new \Exception("Невозможно отобразить модель!!");
    }

}