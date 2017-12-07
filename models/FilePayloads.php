<?php
namespace app\models;

use yii\db\ActiveRecord;

class FilePayloads extends ActiveRecord
{
    public $payloads;

    public static function tableName()
    {
        return '{{files_payloads}}';
    }

    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }
}