<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m240210_135002_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->null(),
            'date_appearance' => $this->timestamp()->null()->defaultExpression(
                'CURRENT_TIMESTAMP'
            ),
            'date_drop' => $this->timestamp()->null(),
            'status' => "ENUM('tree', 'drop', 'rotten') NOT NULL DEFAULT 'tree'",
            'size' => $this->decimal(3, 2)->defaultValue(1),
            'delete' => $this->tinyInteger(1)->defaultValue(0),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
