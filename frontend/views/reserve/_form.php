<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use app\models\Person;
use app\models\Spot;
use frontend\helpers\ReserveTimeHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Reserve */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserve-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reserve_student_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Person::find()->all(), 'person_id', 'person_name'),
        'options' => [
            'placeholder' => 'Select reserve student ...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ])->label('Reserve Student')?>

    <?= $form->field($model, 'reserve_coach_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Person::find()->all(), 'person_id', 'person_name'),
        'options' => [
            'placeholder' => 'Select reserve coach ...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ])->label('Reserve Coach')?>

    <?= $form->field($model, 'reserve_spot_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(Spot::find()->all(), 'spot_id', 'spot_name'),
        'options' => [
            'placeholder' => 'Select reserve spot ...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ])->label('Reserve Spot')?>

    <?= $form->field($model, 'reserve_date')->widget(DatePicker::className(), [
        'options' => [
            'placeholder' => 'Select the reserve date ...',
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ])?>

    <?= $form->field($model, 'reserve_start_time')->widget(Select2::className(), [
        'data' => ReserveTimeHelper::timeSectionArray(),
        'options' => [
            'placeholder' => 'Select time duration ...',
        ],
        'pluginOptions' => [
            'autoclose' => true,
        ]
    ])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
