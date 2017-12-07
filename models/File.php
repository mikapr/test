<?php
namespace app\models;

use DOMDocument;
use yii\db\ActiveRecord;

class File extends ActiveRecord
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'xml'],
            ['file', 'validateFile'],
            ['id', 'integer']
        ];
    }

    public static function tableName()
    {
        return '{{files}}';
    }

    public function validateFile($attribute, $params)
    {
        $xml = new DOMDocument();

        try {
            $xml->load($this->file->tempName);
        } catch (\Exception $e) {}
    }

    public function getPayloads()
    {
        return $this->hasOne(FilePayloads::className(), ['file_id' => 'id']);
    }
}