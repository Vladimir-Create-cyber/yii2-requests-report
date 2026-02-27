<?php

use yii\db\Migration;

/**
 * Таблица заявок
 */
class m260223_104035_create_requests_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%requests}}', [
            'id' => $this->primaryKey(),

            'title' => $this->string(255)->notNull()->comment('Заголовок'),
            'description' => $this->text()->null()->comment('Описание'),

            'agent_id' => $this->integer()->notNull()->comment('Агент'),
            'status' => $this->string(50)->notNull()->defaultValue('new')->comment('Статус'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('idx_requests_agent_id', '{{%requests}}', 'agent_id');

        $this->addForeignKey(
            'fk_requests_agent_id',
            '{{%requests}}',
            'agent_id',
            '{{%agents}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_requests_agent_id', '{{%requests}}');
        $this->dropIndex('idx_requests_agent_id', '{{%requests}}');
        $this->dropTable('{{%requests}}');
    }
}
