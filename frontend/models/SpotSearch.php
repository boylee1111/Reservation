<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Spot;

/**
 * SpotSearch represents the model behind the search form about `app\models\Spot`.
 */
class SpotSearch extends Spot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spot_id'], 'integer'],
            [['spot_name', 'spot_city'], 'safe'],
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
        $query = Spot::find();

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
            'spot_id' => $this->spot_id,
        ]);

        $query->andFilterWhere(['like', 'spot_name', $this->spot_name])
            ->andFilterWhere(['like', 'spot_city', $this->spot_city]);

        return $dataProvider;
    }
}
