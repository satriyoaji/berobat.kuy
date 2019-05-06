<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Pemeriksaan;

/**
 * PemeriksaanSearch represents the model behind the search form of `frontend\models\Pemeriksaan`.
 */
class PemeriksaanSearch extends Pemeriksaan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pemeriksaanID', 'pendaftranID', 'jenisPeriksaID'], 'integer'],
            [['pemeriksaanHasil'], 'safe'],
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
        $query = Pemeriksaan::find();

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
            'pemeriksaanID' => $this->pemeriksaanID,
            'pendaftranID' => $this->pendaftranID,
            'jenisPeriksaID' => $this->jenisPeriksaID,
        ]);

        $query->andFilterWhere(['like', 'pemeriksaanHasil', $this->pemeriksaanHasil]);

        return $dataProvider;
    }
}
