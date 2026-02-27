<?php

use yii\db\Migration;

/**
 * Добавляет в requests:
 * - category
 * - resolved_at
 * - индекс для отчёта
 */
class m260227_143630_alter_requests_add_category_resolved_at extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%requests}}', 'category',
            $this->string(50)->notNull()->defaultValue('other')->comment('Категория')
        );

        $this->addColumn('{{%requests}}', 'resolved_at',
            $this->timestamp()->null()->comment('Дата решения')
        );

        $this->createIndex(
            'idx_requests_status_resolved_at_agent',
            '{{%requests}}',
            ['status', 'resolved_at', 'agent_id']
        );
    }

    public function safeDown()
    {
        $this->dropIndex('idx_requests_status_resolved_at_agent', '{{%requests}}');
        $this->dropColumn('{{%requests}}', 'resolved_at');
        $this->dropColumn('{{%requests}}', 'category');
    }
}