<?php
namespace testwork\promo\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "promo_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $token
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class PromoUser extends \yii\db\ActiveRecord implements IdentityInterface {

    /**
     * Declares the name of the database table associated with this AR class.
     *
     * @return string the table name
     */
    public static function tableName() {
        return 'promo_user';
    }

    /**
     * Returns the validation rules for attributes.
     *
     * @return array validation rules
     */
    public function rules() {
        return [
            [['username', 'email', 'password'], 'required'],
            [['id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'email', 'password', 'auth_key', 'token'], 'string', 'max' => 60],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['token'], 'unique']
        ];
    }

    /**
     * Returns the attribute labels.
     *
     * @return array attribute labels (name => label)
     */
    public function attributeLabels() {
        return [
            'id'            => Yii::t('app', 'ID'),
            'username'      => Yii::t('app', 'Username'),
            'email'         => Yii::t('app', 'Email'),
            'password'      => Yii::t('app', 'Password'),
            'token'         => Yii::t('app', 'Token'),
            'auth_key'      => Yii::t('app', 'Auth Key'),
            'status'        => Yii::t('app', 'Status'),
            'created_at'    => Yii::t('app', 'Created At'),
            'updated_at'    => Yii::t('app', 'Updated At')
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity( $id ) {
        return static::findActiveBy([ 'id' => $id ]);
    }

    /**
     * Login promo user by auth token
     *
     * @param $token
     * @param null $method
     * @return null|IdentityInterface
     */
    public function loginByAccessToken( $token, $method = null ) {
        return static::findIdentityByAccessToken( $token );
    }

    /**
     * Finds an identity by the given token.
     *
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     *
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken( $token, $type = null ) {
        return static::findActiveBy(['token' => $token ]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     *
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.

     * @return string a key that is used to check the validity of a given identity ID.
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * @param string $authKey the given auth key
     *
     * @return bool whether the given auth key is valid.
     */
    public function validateAuthKey( $authKey ) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Creates an PromoUserQuery instance for query purpose.
     *
     * @return PromoUserQuery the active query used by this AR class.
     */
    public static function find() {
        return new PromoUserQuery(get_called_class());
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername( $username ) {
        return static::findActiveBy(['username' => $username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword( $password ) {
        return $this->password === $password;
    }

    /**
     * Find active promo user by condition
     *
     * @param $condition
     * @return array|null|PromoUser
     */
    protected static function findActiveBy( $condition ) {
        return static::find()->where( $condition )->active()->one();
    }
}
