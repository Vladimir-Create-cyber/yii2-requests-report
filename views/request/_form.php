<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var \yii\web\View $this */
/** @var \app\models\Request $model */
/** @var array $agents */

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>

<?= $form->field($model, 'agent_id')->dropDownList($agents, ['prompt' => 'Выберите агента']) ?>

<?= $form->field($model, 'category')->dropDownList(\app\models\Request::categoryList(), ['prompt' => 'Выберите категорию']) ?>

<?= $form->field($model, 'status')->dropDownList(\app\models\Request::statusList(), ['prompt' => 'Выберите статус']) ?>

<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>