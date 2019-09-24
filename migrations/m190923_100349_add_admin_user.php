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
        $admin = \app\models\User::findOne(['username' => 'admin']);
        if (empty($admin)) {
            $password_hash = \Yii::$app->security->generatePasswordHash(env('ADMIN_PASSWORD')); //@todo: заменить на переменную сборки
            $auth_key = \Yii::$app->security->generateRandomString();

            $sql = "insert into users (username, auth_key, password_hash, email)
                    values ('admin', :auth_key, :password_hash, :admin_email)";
            try {
                \Yii::$app->db->createCommand($sql)
                    ->bindValue(':auth_key', $auth_key)
                    ->bindValue(':password_hash', $password_hash)
                    ->bindValue(':admin_email', env('ADMIN_EMAIL'))
                    ->execute();
                return true;
            } catch (\Throwable $exception) {
                echo $exception->getMessage();
                return false;
            }
        }
        return true;
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
