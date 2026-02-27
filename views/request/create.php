<?php

use yii\helpers\Html;

/**
 * Страница создания заявки.
 *
 * @var yii\web\View $this
 * @var app\models\Request $model
 * @var array $agents
 */

$this->title = 'Создать заявку';
?>
    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
    'agents' => $agents,
]) ?>