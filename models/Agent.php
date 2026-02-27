<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель агента (сотрудника, который обрабатывает заявки)
 *
 * @property int $id
 * @property string $full_name
 * @property string $created_at
 *
 * @property Request[] $requests Связанные заявки агента
 */
class Agent extends ActiveRecord
{
    /**
     * Имя таблицы в БД
     */
    public static function tableName()
    {
        return '{{%agents}}';
    }

    /**
     * Правила валидации модели
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],          // обязательно
            [['full_name'], 'string', 'max' => 255], // строка до 255
        ];
    }

    /**
     * Связь: агент имеет много заявок
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['agent_id' => 'id']);
    }
}