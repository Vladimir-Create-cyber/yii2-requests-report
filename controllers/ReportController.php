<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Agent;
use app\models\Request;

/**
 * Отчет: решенные заявки по агентам и категориям.
 */
class ReportController extends Controller
{
    /**
     * /report/index?from=YYYY-MM-DD&to=YYYY-MM-DD
     */
    public function actionIndex()
    {
        $from = Yii::$app->request->get('from', date('Y-m-d'));
        $to = Yii::$app->request->get('to', date('Y-m-d'));

        $fromDt = $from . ' 00:00:00';
        $toDt = $to . ' 23:59:59';

        // Получаем агрегат: agent_id + category + count
        $rows = Request::find()
            ->select(['agent_id', 'category', 'cnt' => 'COUNT(*)'])
            ->where(['status' => Request::STATUS_RESOLVED])
            ->andWhere(['between', 'resolved_at', $fromDt, $toDt])
            ->groupBy(['agent_id', 'category'])
            ->asArray()
            ->all();

        // Список агентов
        $agents = Agent::find()
            ->select(['id', 'full_name'])
            ->orderBy(['full_name' => SORT_ASC])
            ->asArray()
            ->all();

        // Матрица (все агенты, даже если 0)
        $matrix = [];
        foreach ($agents as $a) {
            $matrix[$a['id']] = [
                'name' => $a['full_name'],
                Request::CAT_OFF => 0,
                Request::CAT_CHECK => 0,
                Request::CAT_TECH => 0,
                Request::CAT_OTHER => 0,
                'total' => 0,
            ];
        }

        foreach ($rows as $r) {
            $aid = (int)$r['agent_id'];
            $cat = $r['category'];
            $cnt = (int)$r['cnt'];

            if (!isset($matrix[$aid])) {
                continue;
            }
            if (!array_key_exists($cat, $matrix[$aid])) {
                continue;
            }

            $matrix[$aid][$cat] += $cnt;
            $matrix[$aid]['total'] += $cnt;
        }

        return $this->render('index', [
            'from' => $from,
            'to' => $to,
            'cats' => Request::categoryList(),
            'matrix' => $matrix,
        ]);
    }
}