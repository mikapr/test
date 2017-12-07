<?php
namespace app\controllers;

use app\models\FilePayloads;
use Yii;
use DOMDocument;
use app\models\File;
use yii\web\Controller;
use yii\web\UploadedFile;

class FileController extends Controller
{
    /**
     * @return string
     */
    public function actionUpload()
    {
        $file = new File();

        if (Yii::$app->request->isPost) {

            $file->file = UploadedFile::getInstance($file, 'file');

            $file->name = $file->file->name;

            if (!$file->validate()) {
                $errors = $file->errors;
            } else {
                $tags = [];
                $xml = new DOMDocument();
                $xml->load($file->file->tempName);

                foreach ($xml->getElementsByTagName('*') as $element) {
                    $tags[$element->tagName]++;
                    $tags['count']++;
                }

                $file->created_at = date("y-m-d H:i:s");

                $file->save();

                $filePayloads = new FilePayloads();

                $filePayloads->tags = json_encode($tags);
                $filePayloads->tags_count = json_encode($tags['count']);

                $filePayloads->link('file', $file);
            }

        }

        $files = File::find()->orderBy('id DESC')->asArray()->all();

        $bigFilesCount = File::find()->select('files.*')
            ->leftJoin('{{files_payloads}}', '[[files_payloads.file_id]] = [[files.id]]' )
            ->where('files_payloads.tags_count > :count', [':count' => 20])
            ->with('files_payloads')
            ->count();

        return $this->render('list', compact('file', 'files', 'bigFilesCount'));
    }

    /**
     * @param $id
     * @return string
     */
    public function actionInfo($id)
    {
        $file = File::findOne((int) $id);

        $tags = !empty($file->payloads->tags) ? json_decode($file->payloads->tags, 1) : [];
        unset($tags['count']);

        ksort($tags);

        return $this->render('info', ['file' => $file, 'tags' => $tags]);
    }
}