<?php

namespace app\services;

use Throwable;
use Yii;
use yii\base\Exception;
use yii\web\UploadedFile;

/**
 * Сервис импорта данных из загружаемых файлов
 * Class ImportDataFromFileService
 * @package app\services
 */
class ImportDataFromFileService
{

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @var string
     */
    private $fieldsForImport;

    private $tableName;

    /**
     * ImportDataFromFileService constructor.
     * @param UploadedFile $file
     * @param string $tableName
     * @param array $fields
     * @throws Exception
     */
    public function __construct(UploadedFile $file, string $tableName, array $fields)
    {
        if (!empty(strripos($tableName, ' '))) {
            throw new Exception('incorrect table name');
        }
        $this->file = $file;
        $this->fieldsForImport = implode(',', $fields);
        $this->tableName = $tableName;
    }

    /**
     * @return bool
     */
    public function importFromCsvInDatabase(): bool
    {
        $sql = 'LOAD DATA LOCAL INFILE :csvFile
            INTO TABLE '. $this->tableName . ' 
            FIELDS TERMINATED BY \';\'
            LINES TERMINATED BY \'\n\'
            IGNORE 1 LINES
            ('. $this->fieldsForImport .')';

        try {
            Yii::$app
                ->db
                ->createCommand($sql)
                ->bindValue(':csvFile', $this->file->tempName)
                ->execute();
            return true;
        } catch (Throwable $exception) {
            return false;
        }
    }
}
