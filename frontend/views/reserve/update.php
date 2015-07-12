<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reserve */

$this->title = 'Update Reserve: ' . ' ' . $model->reserve_id;
$this->params['breadcrumbs'][] = ['label' => 'Reserves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reserve_id, 'url' => ['view', 'id' => $model->reserve_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reserve-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
