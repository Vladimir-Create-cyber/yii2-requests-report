<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \app\models\Agent[] $agents
 */

$this->title = 'Агенты';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('+ Добавить агента', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Перейти к заявкам', ['/request/index'], ['class' => 'btn btn-secondary']) ?>
</p>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th style="width: 70px;">ID</th>
        <th>ФИО</th>
        <th style="width: 190px;">Создан</th>
        <th style="width: 140px;">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($agents)): ?>
        <tr>
            <td colspan="4" class="text-center">Пока нет агентов</td>
        </tr>
    <?php else: ?>
        <?php foreach ($agents as $a): ?>
            <tr>
                <td><?= (int)$a->id ?></td>
                <td><?= Html::encode($a->full_name) ?></td>
                <td><?= Html::encode($a->created_at) ?></td>
                <td>
                    <?= Html::a('Удалить', ['delete', 'id' => $a->id], [
                        'class' => 'btn btn-sm btn-danger',
                        'data' => [
                            'confirm' => 'Удалить агента #' . $a->id . '?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>