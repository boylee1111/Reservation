<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spot".
 *
 * @property integer $spot_id
 * @property string $spot_name
 * @property string $spot_city
 *
 * @property Reserve[] $reserves
 */
class Spot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spot_name', 'spot_city'], 'required'],
            [['spot_name', 'spot_city'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'spot_id' => 'Spot ID',
            'spot_name' => 'Spot Name',
            'spot_city' => 'Spot City',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['reserve_spot_id' => 'spot_id']);
    }
}
