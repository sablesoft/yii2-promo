<?php

namespace testwork\promo\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "promo_code".
 *
 * @property integer $id
 * @property string $code
 * @property integer $status
 * @property string $statusName
 * @property string $reward
 * @property integer $zone_id
 * @property string $active_from
 * @property PromoZone $zone
 * @property string $zoneName
 * @property array $zones
 * @property array $statuses
 * @property string $active_until
 */
class PromoCode extends \yii\db\ActiveRecord {

    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string the table name
     */
    public static function tableName() {
        return 'promo_code';
    }

    /**
     * Returns the list of fields that should be returned when no specific fields are specified.
     *
     * @return array
     */
    public function fields() {
        return [
            'code', 'reward', 'zoneName', 'statusName', 'active_from', 'active_until'
        ];
    }

    /**
     * Returns the list of fields that can be expanded further.
     *
     * @return array
     */
    public function extraFields() {
        return [
            'id', 'zone', 'created_at', 'updated_at'
        ];
    }

    /**
     * Returns the validation rules for attributes.
     *
     * @return array validation rules
     */
    public function rules() {
        return [
            [['code', 'reward', 'zone_id'], 'required'],
            [['status', 'zone_id'], 'integer'],
            [['reward'], 'number'],
            [['active_from', 'active_until'], 'safe'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 20],
            [['code'], 'unique']
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
            'code' => Yii::t('app', 'Code'),
            'reward' => Yii::t('app', 'Reward'),
            'zone_id' => Yii::t('app', 'Zone'),
            'zoneName' => Yii::t('app', 'Zone'),
            'active_from' => Yii::t('app', 'Active From'),
            'active_until' => Yii::t('app', 'Active Until'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At')
        ];
    }

    /**
     * Return promo zone model by current zone_id
     *
     * @return PromoCodeQuery
     */
    public function getZone() {
        /** @var PromoCodeQuery $query */
        $query = $this->hasOne( PromoZone::className(), ['id' => 'zone_id'] );
        return $query;
    }

    /**
     * Return current zone name
     *
     * @return string
     */
    public function getZoneName() {
        return $this->zone->name;
    }

    /**
     * Set zone_id by zone name
     *
     * @param $name
     */
    public function setZoneName( $name ) {
        if( $model = PromoZone::findOne([ 'name' => $name ]) )
            $this->zone_id = $model->id;
    }

    /**
     * Get all promo zones
     *
     * @return array
     */
    public function getZones() {
        $zones = PromoZone::find()->select(['id', 'name'])->all();
        return ArrayHelper::map( $zones, 'id', 'name' );
    }

    /**
     * Get status name
     *
     * @return string
     */
    public function getStatusName() {
        return $this->status ?
            Yii::t('app', 'Enabled') :
            Yii::t('app', 'Disabled');
    }

    /**
     * Get all status names
     *
     * @return array
     */
    public function getStatuses() {
        return ['Disabled', 'Enabled'];
    }

    /**
     * Creates an PromoCodeQuery instance for query purpose.
     *
     * @return PromoCodeQuery the active query used by this AR class.
     */
    public static function find() {
        return new PromoCodeQuery( get_called_class() );
    }

}
