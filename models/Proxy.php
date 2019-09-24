<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "proxies".
 *
 * @property int $id
 * @property resource $ip
 * @property int $port
 * @property string $created_at
 * @property string $updated_at
 */
class Proxy extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proxies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'port'], 'required'],
            [['ip'], 'string'],
            [['port'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'port' => 'Порт',
            'created_at' => 'Добавлен',
            'updated_at' => 'Отредактирован',
        ];
    }
}
