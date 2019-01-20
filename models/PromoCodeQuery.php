<?php
namespace testwork\promo\models;

use yii\db\Connection;

/**
 * This is the ActiveQuery class for [[PromoCode]].
 *
 * @see PromoCode
 */
class PromoCodeQuery extends \yii\db\ActiveQuery {

    /**
     * @return $this
     */
    public function active() {
        $time = time();
        return $this->andWhere('[[status]]=1')
                    ->andWhere("[[active_from]] > $time")
                    ->andWhere("[[active_until]] < $time");
    }

    /**
     * Executes query and returns all results as an array.
     *
     * @param Connection $db the DB connection used to create the DB command.
     * If null, the DB connection returned by PromoCode will be used.
     *
     * @return PromoCode[]|array
     */
    public function all( $db = null ) {
        return parent::all( $db );
    }

    /**
     * Executes query and returns a single row of result.
     *
     * @param Connection|null $db the DB connection used to create the DB command.
     *
     * @return PromoCode|array|null
     */
    public function one( $db = null ) {
        return parent::one( $db );
    }
}
