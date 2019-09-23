<?php

namespace app\models;

use app\services\ImportDataFromFileService;
use yii\base\Exception;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadCsvForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $csvFile;
    private $tableName;

    /**
     * UploadCsvForm constructor.
     * @param string $tableName
     * @param array $config
     * @throws Exception
     */
    public function __construct(string $tableName, array $config = [])
    {
        /*Здесь переопределяем конструктор,
        делая обязательным параметр "имя таблицы" для импорта,
        т.к. без него форма не имеет смысла. Проверяем на наличие пробелов в строке*/

        if (!empty(strripos($tableName, ' '))) {
            throw new Exception('incorrect table name');
        }

        $this->tableName = $tableName;
        parent::__construct($config);

    }


    public function rules()
    {
        return [
            [['csvFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv', 'checkExtensionByMimeType' => false], //@todo: включить проверку mime
        ];
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function upload()
    {
        if (!$this->validate()) {
            return false;
        }

        $import = new ImportDataFromFileService($this->csvFile, $this->tableName, ['ip', 'port']);

        try {
            if (true === $import->importFromCsvInDatabase()) {
                return true;
            };

            return false;

        } catch (\Throwable $exception) {
            return false;
        }



    }
}