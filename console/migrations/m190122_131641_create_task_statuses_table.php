<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_statuses`.
 */
class m190122_131641_create_task_statuses_table extends Migration
{
    protected $tableName = 'task_statuses';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)
        ]);

        //Добавляем в табличку базовае статусы.

        $this->batchInsert($this->tableName, ['name'], [
            ['Новая'],
            ['В работе'],
            ['Выполнена'],
            ['Тестирование'],
            ['Доработка'],
            ['Закрыта'],
        ]);

        //$taskTable = \app\models\tables\Tasks::tableName();

        $this->addColumn('tasks', 'status', $this->integer());

        $this->addForeignKey('fk_task_statuses', 'tasks', 'status', $this->tableName, 'id');
        //При обновлении статус всегда возвращать на Новая.
        $this->update('tasks', ['status' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
