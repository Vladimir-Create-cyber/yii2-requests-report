<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель заявки
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $agent_id
 * @property string $status
 * @property string $created_at
 *
 * @property Agent $agent Связанный агент
 */
class Request extends ActiveRecord
{
    /**
     * Имя таблицы в БД
     */
    public static function tableName()
    {
        return '{{%requests}}';
    }

    // ===== Статусы (ТЗ) =====
    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_RESOLVED = 'resolved';

// ===== Категории (ТЗ) =====
    public const CAT_OFF = 'off';
    public const CAT_CHECK = 'check';
    public const CAT_TECH = 'tech';
    public const CAT_OTHER = 'other';

    /**
     * Список статусов для UI.
     * @return array<string,string>
     */
    public static function statusList(): array
    {
        return [
            self::STATUS_NEW => 'Нова',
            self::STATUS_IN_PROGRESS => 'В роботі',
            self::STATUS_RESOLVED => 'Вирішена',
        ];
    }

    /**
     * Список категорий для UI.
     * @return array<string,string>
     */
    public static function categoryList(): array
    {
        return [
            self::CAT_OFF => 'Відключення',
            self::CAT_CHECK => 'Перевірка/здешевлення',
            self::CAT_TECH => 'Технічне питання',
            self::CAT_OTHER => 'Інше',
        ];
    }

    /**
     * Правила валидации
     */
    public function rules()
    {
        return [
            [['title', 'agent_id', 'status', 'category'], 'required'],
            [['description'], 'string'],
            [['agent_id'], 'integer'],
            [['status'], 'in', 'range' => array_keys(self::statusList())],
            [['category'], 'in', 'range' => array_keys(self::categoryList())],
            [['created_at', 'resolved_at'], 'safe'],
        ];
    }

    /**
     * Связь: заявка принадлежит агенту
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgent()
    {
        return $this->hasOne(Agent::class, ['id' => 'agent_id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->status === self::STATUS_RESOLVED) {
            if (empty($this->resolved_at)) {
                $this->resolved_at = date('Y-m-d H:i:s');
            }
        } else {
            $this->resolved_at = null;
        }

        return true;
    }

    public function getStatusLabel(): string
    {
        return self::statusList()[$this->status] ?? $this->status;
    }

    public function getCategoryLabel(): string
    {
        return self::categoryList()[$this->category] ?? $this->category;
    }
}