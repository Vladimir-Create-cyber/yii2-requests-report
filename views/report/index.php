<?php

use yii\helpers\Html;

/** @var \yii\web\View $this */
/** @var string $from */
/** @var string $to */
/** @var array $cats */
/** @var array $matrix */

$this->title = 'Отчет по решенным заявкам';
?>

<h1><?= Html::encode($this->title) ?></h1>

<form method="get" class="row g-2" style="max-width: 720px; margin-bottom: 15px;">
    <div class="col-auto">
        <label class="form-label">Дата решения: с</label>
        <input type="date" name="from" class="form-control" value="<?= Html::encode($from) ?>">
    </div>
    <div class="col-auto">
        <label class="form-label">по</label>
        <input type="date" name="to" class="form-control" value="<?= Html::encode($to) ?>">
    </div>
    <div class="col-auto" style="padding-top: 32px;">
        <button class="btn btn-primary" type="submit">Показать</button>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>ПІБ (хто вирішив заявку)</th>
        <th><?= Html::encode($cats[\app\models\Request::CAT_OFF]) ?></th>
        <th><?= Html::encode($cats[\app\models\Request::CAT_CHECK]) ?></th>
        <th><?= Html::encode($cats[\app\models\Request::CAT_TECH]) ?></th>
        <th><?= Html::encode($cats[\app\models\Request::CAT_OTHER]) ?></th>
        <th>Усього</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($matrix)): ?>
        <tr><td colspan="6" class="text-center">Нет данных</td></tr>
    <?php else: ?>
        <?php foreach ($matrix as $row): ?>
            <tr>
                <td><?= Html::encode($row['name']) ?></td>
                <td><?= (int)$row[\app\models\Request::CAT_OFF] ?></td>
                <td><?= (int)$row[\app\models\Request::CAT_CHECK] ?></td>
                <td><?= (int)$row[\app\models\Request::CAT_TECH] ?></td>
                <td><?= (int)$row[\app\models\Request::CAT_OTHER] ?></td>
                <td><b><?= (int)$row['total'] ?></b></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>