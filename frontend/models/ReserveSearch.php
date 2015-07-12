<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reserve;

/**
 * ReserveSearch represents the model behind the search form about `app\models\Reserve`.
 */
class ReserveSearch extends Reserve
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reserve_id', 'reserve_student_id', 'reserve_coach_id', 'reserve_spot_id'], 'integer'],
            [['reserve_start_time', 'reserve_end_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reserve::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'reserve_id' => $this->reserve_id,
            'reserve_student_id' => $this->reserve_student_id,
            'reserve_coach_id' => $this->reserve_coach_id,
            'reserve_spot_id' => $this->reserve_spot_id,
            'reserve_start_time' => $this->reserve_start_time,
            'reserve_end_time' => $this->reserve_end_time,
        ]);

        return $dataProvider;
    }
}
