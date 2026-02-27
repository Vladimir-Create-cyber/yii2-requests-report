<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * Форма агента.
 *
 * @var yii\web\View $this
 * @var \app\models\Agent $model
 */

$form = ActiveForm::begin();
?>

<?= $form->field($model, 'full_name')->textInput([
    'maxlength' => true,
    'placeholder' => 'Например: Иван Иванов',
]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('← Назад', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

<?php ActiveForm::end(); ?>