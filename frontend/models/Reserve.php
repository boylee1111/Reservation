<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserve".
 *
 * @property integer $reserve_id
 * @property integer $reserve_student_id
 * @property integer $reserve_coach_id
 * @property integer $reserve_spot_id
 * @property string $reserve_start_time
 * @property string $reserve_end_time
 *
 * @property Person $reserveCoach
 * @property Person $reserveStudent
 * @property Spot $reserveSpot
 */
class Reserve extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reserve';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reserve_student_id', 'reserve_coach_id', 'reserve_spot_id', 'reserve_start_time', 'reserve_end_time'], 'required'],
            [['reserve_student_id', 'reserve_coach_id', 'reserve_spot_id'], 'integer'],
            [['reserve_start_time', 'reserve_end_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reserve_id' => 'Reserve ID',
            'reserve_student_id' => 'Reserve Student ID',
            'reserve_coach_id' => 'Reserve Coach ID',
            'reserve_spot_id' => 'Reserve Spot ID',
            'reserve_start_time' => 'Reserve Start Time',
            'reserve_end_time' => 'Reserve End Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveCoach()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'reserve_coach_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveStudent()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'reserve_student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveSpot()
    {
        return $this->hasOne(Spot::className(), ['spot_id' => 'reserve_spot_id']);
    }
}
