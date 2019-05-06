<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JenisPeriksa;

/**
 * JenisPeriksaSearch represents the model behind the search form of `backend\models\JenisPeriksa`.
 */
class JenisPeriksaSearch extends JenisPeriksa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenisPeriksaID'], 'integer'],
            [['jenisPeriksaNama'], 'safe'],
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
        $query = JenisPeriksa::find();

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
            'jenisPeriksaID' => $this->jenisPeriksaID,
        ]);

        $query->andFilterWhere(['like', 'jenisPeriksaNama', $this->jenisPeriksaNama]);

        return $dataProvider;
    }
}
