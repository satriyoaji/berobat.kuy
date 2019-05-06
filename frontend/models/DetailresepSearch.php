<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Detailresep;

/**
 * DetailresepSearch represents the model behind the search form of `frontend\models\Detailresep`.
 */
class DetailresepSearch extends Detailresep
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detailResepID', 'obatID', 'resepID', 'detailResepQuantity', 'detailResepSubtotal'], 'integer'],
            [['detailResepDosis'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Detailresep::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'detailResepID' => $this->detailResepID,
            'obatID' => $this->obatID,
            'resepID' => $this->resepID,
            'detailResepQuantity' => $this->detailResepQuantity,
            'detailResepSubtotal' => $this->detailResepSubtotal,
        ]);

        $query->andFilterWhere(['like', 'detailResepDosis', $this->detailResepDosis]);

        return $dataProvider;
    }
}
