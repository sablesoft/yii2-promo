<?php
use yii\db\Migration;
use testwork\promo\models\PromoZone;

/**
 * Class m171212_193503_insert_promo_zone_data
 */
class m171212_193503_insert_promo_zone_data extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        foreach( $this->getZones() as $zone )
            ( new PromoZone([ 'name' => $zone ]) )->save();
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        return false;
    }

    protected function getZones() {
        return [
            'New York',
            'Amsterdam',
            'Moscow',
            'Minsk',
            'Kiev'
        ];
    }
}
