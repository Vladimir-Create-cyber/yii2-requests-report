<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Agent;

/**
 * CRUD-контроллер для агентов.
 */
class AgentController extends Controller
{
    /**
     * Удаление только POST.
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
     * Список агентов.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $agents = Agent::find()
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'agents' => $agents,
        ]);
    }

    /**
     * Создание агента.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Agent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Удаление агента.
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
     * @param int $id
     * @return Agent
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): Agent
    {
        $model = Agent::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Агент не найден.');
        }
        return $model;
    }
}