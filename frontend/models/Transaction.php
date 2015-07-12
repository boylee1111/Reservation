<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $transaction_id
 * @property integer $transaction_person_id
 * @property string $transaction_time
 * @property boolean $is_closed
 *
 * @property Person $transactionPerson
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_person_id', 'transaction_time'], 'required'],
            [['transaction_person_id'], 'integer'],
            [['transaction_time'], 'safe'],
            [['is_closed'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transaction_id' => 'Transaction ID',
            'transaction_person_id' => 'Transaction Person ID',
            'transaction_time' => 'Transaction Time',
            'is_closed' => 'Is Closed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'transaction_person_id']);
    }
}
