<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'person_wechat_id') ?>

    <?= $form->field($model, 'person_name') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?= $form->field($model, 'is_student')->checkbox() ?>

    <?php // echo $form->field($model, 'is_coach')->checkbox() ?>

    <?php // echo $form->field($model, 'person_rate') ?>

    <?php // echo $form->field($model, 'recommend_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
