<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \app\models\Agent $model
 */

$this->title = 'Добавить агента';
?>
    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>