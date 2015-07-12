<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Spot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'spot_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spot_city')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
