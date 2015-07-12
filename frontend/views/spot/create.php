<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Spot */

$this->title = 'Create Spot';
$this->params['breadcrumbs'][] = ['label' => 'Spots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
