<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promo_code`.
 */
class m171212_202134_create_promo_code_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('promo_code', [
            'id' => $this->primaryKey(),
            'code'                  => 'string UNIQUE NOT NULL',
            'reward'                => 'money NOT NULL',
            'zone_id'               => 'integer NOT NULL',
            'active_from'           => 'timestamp DEFAULT CURRENT_TIMESTAMP',
            'active_until'          => 'timestamp DEFAULT CURRENT_TIMESTAMP',
            'status'                => 'boolean DEFAULT 1',
            // history fields:
            'created_at'  => 'timestamp DEFAULT CURRENT_TIMESTAMP',
            'updated_at'  => 'timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->addForeignKey(
            'promo_code_zone',
            'promo_code', 'zone_id',
            'promo_zone', 'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropForeignKey('promo_code_zone', 'promo_code');
        $this->dropTable('promo_code');
    }

}
