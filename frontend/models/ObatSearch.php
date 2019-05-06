<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Obat;

/**
 * ObatSearch represents the model behind the search form of `frontend\models\Obat`.
 */
class ObatSearch extends Obat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['obatID', 'obatHarga'], 'integer'],
            [['obatNama', 'obatGolongan', 'obatFoto'], 'safe'],
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
        $query = Obat::find();

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
            'obatID' => $this->obatID,
            'obatHarga' => $this->obatHarga,
        ]);

        $query->andFilterWhere(['like', 'obatNama', $this->obatNama])
            ->andFilterWhere(['like', 'obatGolongan', $this->obatGolongan])
            ->andFilterWhere(['like', 'obatFoto', $this->obatFoto]);

        return $dataProvider;
    }
}
