<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promo_zone`.
 */
class m171212_192753_create_promo_zone_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('promo_zone', [
            'id'    => $this->primaryKey(),
            'name'  => 'string UNIQUE NOT NULL',
            // history fields:
            'created_at'  => 'timestamp DEFAULT CURRENT_TIMESTAMP',
            'updated_at'  => 'timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('promo_zone');
    }
}
