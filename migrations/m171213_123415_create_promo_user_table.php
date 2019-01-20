<?php
use yii\db\Migration;

/**
 * Handles the creation of table `promo_user`.
 */
class m171213_123415_create_promo_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('promo_user', [
            'id'        => $this->primaryKey(),
            'username'  => 'string UNIQUE NOT NULL',
            'email'     => 'string UNIQUE NOT NULL',
            'password'  => 'string NOT NULL',
            'token'     => 'string UNIQUE',
            'auth_key'  => 'string',
            'status'    => 'boolean DEFAULT 1',
            // history fields:
            'created_at'  => 'timestamp DEFAULT CURRENT_TIMESTAMP',
            'updated_at'  => 'timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('promo_user');
    }

}
