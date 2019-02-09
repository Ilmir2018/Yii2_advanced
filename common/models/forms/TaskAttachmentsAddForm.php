<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.01.2019
 * Time: 12:55
 */

namespace common\models\forms;

use common\models\tables\TaskAttachments;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class TaskAttachmentsAddForm extends Model
{

    public $taskId;
    /** @var  UploadedFile */
    public $file;

    protected $originalDir = '@img/tasks/';
    protected $copiesDir = '@img/tasks/small/';

    protected $filename;
    protected $filepath;

    protected $model;

    public function rules()
    {
        return [
            [['taskId', 'file'], 'required'],
            [['taskId'], 'integer'],
            [['file'], 'file', 'extensions' => ['jpg', 'png']],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $this->saveUploadedFile();
            $this->createMinCopy();
            return $this->saveData();
        }
        return false;
    }

    protected function saveData()
    {
        $this->model = new TaskAttachments([
            'task_id' => $this->taskId,
            'path' => $this->filename
        ]);
        return $this->model->save();

    }

    protected function saveUploadedFile()
    {
        $this->filename = \Yii::$app->getSecurity()->generateRandomString(12)
            . "." . $this->file->getExtension();
        $this->filepath = \Yii::getAlias("{$this->originalDir}{$this->filename}");
        $this->file->saveAs($this->filepath);
    }

    protected function createMinCopy()
    {
        Image::thumbnail($this->filepath, 100, 100)
            ->save(\Yii::getAlias("{$this->copiesDir}{$this->filename}"));
    }

}