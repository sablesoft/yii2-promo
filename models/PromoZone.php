<?php
namespace testwork\promo\models;

use Yii;

/**
 * This is the model class for table "promo_zone".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PromoCode[] $codes
 */
class PromoZone extends \yii\db\ActiveRecord {

    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string the table name
     */
    public static function tableName() {
        return 'promo_zone';
    }

    /**
     * Returns the validation rules for attributes.
     *
     * @return array validation rules
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique']
        ];
    }

    /**
     * Returns the attribute labels.
     *
     * @return array attribute labels (name => label)
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Promo codes by current id getter
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodes() {
        return $this->hasMany( PromoCode::className(), ['zone_id' => 'id'] );
    }
}
