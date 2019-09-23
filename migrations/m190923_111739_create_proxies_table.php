<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%proxies}}`.
 */
class m190923_111739_create_proxies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%proxies}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->binary(16)->notNull(),
            'port' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->defaultValue((new \yii\db\Expression('NOW()'))),
            'updated_at' =>$this->dateTime()->defaultValue((new \yii\db\Expression('NOW()'))),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%proxies}}');
    }
}
