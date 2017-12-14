<?php

namespace testwork\promo\models;

use yii\db\Connection;

/**
 * This is the ActiveQuery class for [[PromoUser]].
 *
 * @see PromoUser
 */
class PromoUserQuery extends \yii\db\ActiveQuery {

    /**
     * Add active promo user filter in select
     *
     * @return $this
     */
    public function active() {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * Executes query and returns all results as an array.
     *
     * @param Connection $db the DB connection used to create the DB command.
     * If null, the DB connection returned by PromoCode will be used.
     *
     * @return PromoUser[]|array
     */
    public function all( $db = null ) {
        return parent::all($db);
    }

    /**
     * Executes query and returns a single row of result.
     *
     * @param Connection|null $db the DB connection used to create the DB command.
     *
     * @return PromoUser|null
     */
    public function one( $db = null ) {
        return parent::one($db);
    }

}
