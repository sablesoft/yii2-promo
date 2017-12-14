<?php

namespace testwork\promo\controllers;

use yii\rest\Action;
use yii\rest\ActiveController;
use yii\db\ActiveRecordInterface;
use yii\web\NotFoundHttpException;
use testwork\promo\models\PromoCode;
use yii\filters\auth\HttpBearerAuth;

/**
 * ApiController implements the REST actions with HttpBearerAuth for PromoCode model.
 */
class ApiController extends ActiveController {

    /** @var string $modelClass - the model class name */
    public $modelClass = 'testwork\promo\models\PromoCode';

    /**
     * @return array
     */
    public function behaviors() {
        return array_merge( parent::behaviors(), [
            'authenticator' => [
                'class' => HttpBearerAuth::className()
            ]
        ]);
    }

    /**
     * @return array
     */
    public function actions() {
        return array_map( function( $action ) {
            return array_merge( $action,
                ['findModel' => [ $this, 'findModel' ] ]
            );
        }, parent::actions() );
    }

    /**
     * @param $id - id or code
     * @param Action $action
     * @return PromoCode
     * @throws NotFoundHttpException
     */
    public function findModel( $id, Action $action ) {
        $action->findModel = null;
        try {
            $model = $action->findModel( $id );
        } catch ( NotFoundHttpException $e ) {
            /* @var $modelClass ActiveRecordInterface */
            $modelClass = $this->modelClass;
            $model = $modelClass::findOne([ 'code' => $id ]);
        }
        /** @var PromoCode $model */
        if( isset( $model ) )
            return $model;

        throw new NotFoundHttpException("Object not found: $id");
    }

}