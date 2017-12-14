<?php

use yii\db\Migration;
use testwork\promo\models\PromoUser;

/**
 * Class m171214_143616_insert_test_user_data
 */
class m171214_143616_insert_test_user_data extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        foreach( $this->getUsers() as $data )
            ( new PromoUser( $data ) )->save();
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        return false;
    }

    protected function getUsers() {
        return [
            [
                'username'  => 'admin',
                'email'     => 'admin@test.com',
                'password'  => 'admin',
                'token'     => 'adminToken'
            ],
            [
                'username'  => 'demo',
                'email'     => 'demo@test.com',
                'password'  => 'demo',
                'token'     => 'demoToken'
            ],
            [
                'username'  => 'disabled',
                'email'     => 'disabled@test.com',
                'password'  => 'disabled',
                'token'     => 'disabledToken',
                'status'    => 0
            ]
        ];
    }

}
