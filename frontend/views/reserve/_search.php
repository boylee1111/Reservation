<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserve-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'reserve_id') ?>

    <?= $form->field($model, 'reserve_student_id') ?>

    <?= $form->field($model, 'reserve_coach_id') ?>

    <?= $form->field($model, 'reserve_spot_id') ?>

    <?= $form->field($model, 'reserve_start_time') ?>

    <?php // echo $form->field($model, 'reserve_end_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
