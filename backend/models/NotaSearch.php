<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Nota;

/**
 * NotaSearch represents the model behind the search form of `backend\models\Nota`.
 */
class NotaSearch extends Nota
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notaID', 'kasirID', 'notaTotalHarga', 'pemeriksaanID', 'resepID'], 'integer'],
            [['notaStatus'], 'safe'],
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
        $query = Nota::find();

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
            'notaID' => $this->notaID,
            'kasirID' => $this->kasirID,
            'notaTotalHarga' => $this->notaTotalHarga,
            'pemeriksaanID' => $this->pemeriksaanID,
            'resepID' => $this->resepID,
        ]);

        $query->andFilterWhere(['like', 'notaStatus', $this->notaStatus]);

        return $dataProvider;
    }
}
