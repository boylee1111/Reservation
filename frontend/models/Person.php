<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $person_id
 * @property string $person_wechat_id
 * @property string $person_name
 * @property string $phone_number
 * @property boolean $is_student
 * @property boolean $is_coach
 * @property integer $person_rate
 * @property integer $recommend_by
 *
 * @property Person $recommendBy
 * @property Person[] $people
 * @property Reserve[] $reserves
 * @property Reserve[] $reserves0
 * @property Transaction[] $transactions
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_wechat_id', 'person_name', 'phone_number'], 'required'],
            [['is_student', 'is_coach'], 'boolean'],
            [['person_rate', 'recommend_by'], 'integer'],
            [['person_wechat_id'], 'string', 'max' => 225],
            [['person_name', 'phone_number'], 'string', 'max' => 255],
            [['person_wechat_id'], 'unique'],
            [['phone_number'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'person_wechat_id' => 'Person Wechat ID',
            'person_name' => 'Person Name',
            'phone_number' => 'Phone Number',
            'is_student' => 'Is Student',
            'is_coach' => 'Is Coach',
            'person_rate' => 'Person Rate',
            'recommend_by' => 'Recommend By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendBy()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'recommend_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['recommend_by' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['reserve_coach_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserves0()
    {
        return $this->hasMany(Reserve::className(), ['reserve_student_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['transaction_person_id' => 'person_id']);
    }
}
