<?php

use yii\helpers\Html;

/** @var \yii\web\View $this */
/** @var \app\models\Request $model */

$this->title = 'Заявка #' . $model->id;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?= $model->id ?></td>
    </tr>
    <tr>
        <th>Заголовок</th>
        <td><?= Html::encode($model->title) ?></td>
    </tr>
    <tr>
        <th>Описание</th>
        <td><?= Html::encode($model->description) ?></td>
    </tr>
    <tr>
        <th>Агент</th>
        <td><?= $model->agent ? Html::encode($model->agent->full_name) : '—' ?></td>
    </tr>
    <tr>
        <th>Статус</th>
        <td><?= Html::encode($model->status) ?></td>
    </tr>
    <tr>
        <th>Создано</th>
        <td><?= $model->created_at ?></td>
    </tr>
</table>

<p>
    <?= Html::a('← Назад', ['index'], ['class' => 'btn btn-secondary']) ?>
</p>