<?php

use yii\db\Migration;

class m260223_092524_create_agents_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%agents}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull()->comment('ПІБ агента'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%agents}}');
    }
}
