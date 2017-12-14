<?php

namespace testwork\promo\models;

use yii\db\Query;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PromoCodeSearch represents the model behind the search form about `testwork\promo\models\PromoCode`.
 */
class PromoCodeSearch extends PromoCode {

    /** @var string $zoneName - current zone name */
    public $zoneName;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['zoneName'], 'string'],
            [['id', 'status', 'zone_id'], 'integer'],
            [['code', 'active_from', 'active_until'], 'safe'],
            [['code'], 'unique'],
            [['reward'], 'number']
        ];
    }

    /**
     * Returns a list of scenarios and the corresponding active attributes.
     *
     * @return array a list of scenarios and the corresponding active attributes.
     */
    public function scenarios() {
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
    public function search( $params ) {

        $query = PromoCode::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'code',
                'status',
                'reward',
                'zone_id' => [
                    'asc' => [ 'promo_zone.name' => SORT_ASC ],
                    'desc' => [ 'promo_zone.name' => SORT_DESC ],
                    'label' => 'Zone'
                ],
                'zoneName' => [
                    'asc' => [ 'promo_zone.name' => SORT_ASC ],
                    'desc' => [ 'promo_zone.name' => SORT_DESC ],
                    'label' => 'Zone'
                ],
                'active_from',
                'active_until'
            ]
        ]);

        $this->load( $params );

        if( !$this->validate() ) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['zone']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'reward' => $this->reward,
            'zone_id' => $this->zone_id
        ]);

        if( $from = $this->formatDate( $this->active_from ) )
            $query->andFilterWhere([ '>=', 'active_from', $from ]);

        if( $until = $this->formatDate( $this->active_until ) )
            $query->andFilterWhere([ '<=', 'active_until', $until ]);

        $query->joinWith([ 'zone' => function( $q ) {
            /** @var Query $q */
            $q->where('promo_zone.name LIKE "%' . $this->zoneName . '%"');
        }]);

        $query->andFilterWhere([ 'like', 'code', $this->code ]);

        return $dataProvider;
    }

    /**
     * @param null|string $date
     * @return null|string
     */
    protected function formatDate( $date ) {
        return ( !empty( $date ) )?
            date("Y-m-d H:i:s", strtotime( $date ) ): null;
    }

}
