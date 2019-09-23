<?php

use yii\db\Migration;

/**
 * Class m190923_100349_add_admin_user
 */
class m190923_100349_add_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $password_hash = \Yii::$app->security->generatePasswordHash('password'); //@todo: заменить на переменную сборки
        $auth_key = \Yii::$app->security->generateRandomString();

        $sql = "insert into users (username, auth_key, password_hash, email)
                    values ('admin', :auth_key, :password_hash, 'admin@admin.com')";
        try {
            \Yii::$app->db->createCommand($sql)
                ->bindValue(':auth_key', $auth_key)
                ->bindValue(':password_hash', $password_hash)
                ->execute();
            return true;
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DELETE FROM users WHERE username = 'admin'";
        \Yii::$app->db->createCommand($sql)->execute();
        return true;
    }
}
