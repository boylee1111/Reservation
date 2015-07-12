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
            [['reserve_date', 'reserve_start_time', 'reserveStudent.person_name', 'reserveCoach.person_name', 'reserveSpot.spot_name'], 'safe'],
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

    public function attributes()
    {
        return array_merge(parent::attributes(), ['reserveStudent.person_name', 'reserveCoach.person_name', 'reserveSpot.spot_name']);
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

        $dataProvider->sort->attributes['reserveStudent.person_name'] = [
            'asc' => ['person.person_name' => SORT_ASC],
            'desc' => ['person.person_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['reserveCoach.person_name'] = [
            'asc' => ['person.person_name' => SORT_ASC],
            'desc' => ['person.person_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['reserveSpot.spot_name'] = [
            'asc' => ['spot.spot_name' => SORT_ASC],
            'desc' => ['spot.spot_name' => SORT_DESC],
        ];

        $query->joinWith(['reserveStudent', 'reserveSpot']);

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
            'reserve_date' => $this->reserve_date,
            'reserve_start_time' => $this->reserve_start_time,
        ]);

        $query->andFilterWhere(['like', 'person.person_name', $this->getAttribute('reserveStudent.person_name')])
            ->andFilterWhere(['like', 'person.person_name', $this->getAttribute('reserveCoach.person_name')])
            ->andFilterWhere(['like', 'spot.spot_name', $this->getAttribute('spot.spot_name')]);

        return $dataProvider;
    }
}
