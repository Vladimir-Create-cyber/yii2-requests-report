<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Request;
use app\models\Agent;

/**
 * CRUD-контроллер для заявок.
 */
class RequestController extends Controller
{
    /**
     * Ограничиваем удаление только POST-запросом.
     *
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Список заявок.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $requests = Request::find()
            ->with('agent')
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'requests' => $requests,
        ]);
    }

    /**
     * Создание заявки.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'agents' => $this->getAgentsList(),
        ]);
    }

    /**
     * Просмотр заявки.
     *
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Редактирование заявки.
     *
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'agents' => $this->getAgentsList(),
        ]);
    }

    /**
     * Удаление заявки.
     *
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Поиск заявки по id.
     *
     * @param int $id
     * @return Request
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): Request
    {
        $model = Request::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Заявка не найдена.');
        }
        return $model;
    }

    /**
     * Список агентов для выпадающего списка.
     *
     * Формат: [id => full_name]
     *
     * @return array
     */
    protected function getAgentsList(): array
    {
        return Agent::find()
            ->select(['full_name', 'id'])
            ->indexBy('id')
            ->column();
    }
}