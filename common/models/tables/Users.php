<?php

namespace common\models\tables;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $login
 * @property string $password
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord
{
    const SCENARIO_AUTH = 'auth';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'username', 'password', 'email'], 'required'],
            [['first_name', 'last_name', 'username', 'password', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'login' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
        ];
    }
    //Связываю таблицу tasks и users
    public function getUser()
    {
        return $this->hasOne(Users::class,["id" => "responsible_id"]);
    }

    //Переопределяем возвращаемые поля
    public function fields()
    {
        if ($this->scenario == self::SCENARIO_AUTH){
            return [
                'id',
                'username' => 'login',
                'password',
            ];
        }
        return parent::fields();
    }

    public static function getUsersList(){
        $users = static::find()
            ->select(['id', 'username'])
            ->asArray()
            ->all();

        return ArrayHelper::map($users, 'id', 'username');
    }
}
