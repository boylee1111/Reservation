<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reserve */

$this->title = $model->reserve_id;
$this->params['breadcrumbs'][] = ['label' => 'Reserves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->reserve_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->reserve_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
