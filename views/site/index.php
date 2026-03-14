<?php

use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Панель управления';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Добро пожаловать!</h1>
        <p class="lead">Система учета заявок и управления агентами.</p>
    </div>

    <div class="body-content">
        <div class="row justify-content-center">

            <div class="col-lg-5 mb-3 text-center">
                <h2>Заявки</h2>
                <p>Просмотр, создание и редактирование заявок. Отслеживание статусов и назначение агентов на выполнение задач.</p>
                <p>
                    <a class="btn btn-lg btn-outline-primary" href="<?= Url::to(['/request/index']) ?>">
                        Перейти к заявкам &raquo;
                    </a>
                </p>
            </div>

            <div class="col-lg-5 mb-3 text-center">
                <h2>Агенты</h2>
                <p>Управление списком сотрудников, просмотр информации, контактных данных и статистики по агентам.</p>
                <p>
                    <a class="btn btn-lg btn-outline-success" href="<?= Url::to(['/agent/index']) ?>">
                        Перейти к агентам &raquo;
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>