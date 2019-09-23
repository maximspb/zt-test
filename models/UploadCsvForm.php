<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadCsvForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $csvFile;

    public function rules()
    {
        return [
            [['csvFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv', 'checkExtensionByMimeType' => false],
        ];
    }

    public function upload()
    {
        if (!$this->validate()) {
            return false;
        }

        //var_dump($this->csvFile->tempName); die();

        $sql = 'LOAD DATA LOCAL INFILE :csvFile INTO TABLE proxies FIELDS TERMINATED BY \',\'
LINES TERMINATED BY \'\n\' IGNORE 1 LINES (ip, port)';

        \Yii::$app->db->createCommand($sql)->bindValue(':csvFile', $this->csvFile->tempName)->execute();

        //$this->csvFile->saveAs('uploads/' . $this->csvFile->baseName . '.' . $this->csvFile->extension);
        return true;
    }
}