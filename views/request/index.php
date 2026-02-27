<?php

use yii\helpers\Html;

/**
 * Список заявок.
 *
 * @var yii\web\View $this
 * @var \app\models\Request[] $requests
 */

$this->title = 'Заявки';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('+ Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th style="width: 70px;">ID</th>
        <th>Заголовок</th>
        <th>Агент</th>
        <th style="width: 140px;">Статус</th>
        <th style="width: 220px;">Категория</th>
        <th style="width: 190px;">Создано</th>
        <th style="width: 190px;">Решено</th>
        <th style="width: 260px;">Действия</th>
    </tr>
    </thead>

    <tbody>
    <?php if (empty($requests)): ?>
        <tr>
            <td colspan="8" class="text-center">Пока нет заявок</td>
        </tr>
    <?php else: ?>
        <?php foreach ($requests as $r): ?>
            <tr>
                <td><?= (int)$r->id ?></td>

                <td><?= Html::encode($r->title) ?></td>

                <td>
                    <?= $r->agent ? Html::encode($r->agent->full_name) : '—' ?>
                </td>

                <!-- Статус (красиво названием) -->
                <td><?= Html::encode($r->getStatusLabel()) ?></td>

                <!-- Категория (красиво названием) -->
                <td><?= Html::encode($r->getCategoryLabel()) ?></td>

                <td><?= Html::encode($r->created_at) ?></td>

                <!-- Дата решения (если есть) -->
                <td><?= $r->resolved_at ? Html::encode($r->resolved_at) : '—' ?></td>

                <td>
                    <?= Html::a('Открыть', ['view', 'id' => $r->id], ['class' => 'btn btn-sm btn-secondary']) ?>

                    <?= Html::a('Редактировать', ['update', 'id' => $r->id], ['class' => 'btn btn-sm btn-primary']) ?>

                    <?= Html::a('Удалить', ['delete', 'id' => $r->id], [
                        'class' => 'btn btn-sm btn-danger',
                        'data' => [
                            'confirm' => 'Удалить заявку #' . $r->id . '?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>