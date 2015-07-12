<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReserveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reserves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reserve', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'reserve_id',
            [
                'attribute' => 'reserveStudent.person_name',
                'label' => 'Student',
            ],
            [
                'attribute' => 'reserveCoach.person_name',
                'label' => 'Coach',
            ],
            [
                'attribute' => 'reserveSpot.spot_name',
                'label' => 'Spot',
            ],
            [
                'attribute' => 'reserve_date',
                'format' => ['date', 'php:Y-m-d'],
                'label' => 'Date',
            ],
            [
                'attribute' => 'reserve_start_time',
                'format' => ['date', 'php:HH-mm'],
                'label' => 'Start Time',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
