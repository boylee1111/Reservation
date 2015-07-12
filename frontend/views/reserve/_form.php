<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reserve */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserve-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reserve_student_id')->textInput() ?>

    <?= $form->field($model, 'reserve_coach_id')->textInput() ?>

    <?= $form->field($model, 'reserve_spot_id')->textInput() ?>

    <?= $form->field($model, 'reserve_start_time')->textInput() ?>

    <?= $form->field($model, 'reserve_end_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
