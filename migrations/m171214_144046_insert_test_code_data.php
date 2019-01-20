<?php
use yii\db\Migration;
use testwork\promo\models\PromoCode;

/**
 * Class m171214_144046_insert_test_code_data
 */
class m171214_144046_insert_test_code_data extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        foreach( $this->getCodes() as $data )
            ( new PromoCode( $data ) )->save();
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        return false;
    }

    protected function getCodes() {

        return [
            [
                'code'          => 'firstTest',
                'reward'        => 10,
                'zone_id'       => 1,
                'active_from'   => date('Y-m-d H:i:s'),
                'active_until'  => '2018-01-01'
            ],
            [
                'code'          => 'secondTest',
                'reward'        => 20,
                'zone_id'       => 2,
                'active_from'   => '2017-10-01',
                'active_until'  => '2018-01-05'
            ],
            [
                'code'          => 'disabled',
                'reward'        => 100,
                'zone_id'       => 5,
                'active_from'   => '2015-01-10',
                'active_until'  => '2025-03-27',
                'status'        => 0
            ],
            [
                'code'          => 'super',
                'reward'        => 10000,
                'zone_id'       => 4,
                'active_from'   => '2015-01-10',
                'active_until'  => '2025-03-27'
            ],
            [
                'code'          => 'hot',
                'reward'        => 1000,
                'zone_id'       => 1,
                'active_from'   => '2017-12-12',
                'active_until'  => '2017-12-28'
            ]
        ];
    }
}
