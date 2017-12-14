<?php

namespace testwork\promo\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use testwork\promo\models\LoginForm;
use testwork\promo\models\PromoCode;
use testwork\promo\models\PromoCodeSearch;

/**
 * CrudController implements the CRUD actions for PromoCode model.
 */
class CrudController extends Controller {

    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array the behavior configurations.
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST']
                ]
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'     => false,
                        'actions'   => ['login'],
                        'roles'     => ['@']
                    ],
                    [
                        'allow'     => true,
                        'actions'   => ['login'],
                        'roles'     => ['?']
                    ],
                    [
                        'allow'     => true,
                        'roles'     => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all PromoCode models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PromoCodeSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->post() );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PromoCode model.
     * @param integer $id
     * @return mixed
     */
    public function actionView( $id ) {
        return $this->render('view', [
            'model' => $this->findModel( $id )
        ]);
    }

    /**
     * Creates a new PromoCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PromoCode();

        if( $model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->redirect([ 'view', 'id' => $model->id ]);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing PromoCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate( $id ) {
        $model = $this->findModel( $id );

        if( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            return $this->redirect([ 'view', 'id' => $model->id ]);
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing PromoCode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete( $id ) {
        $this->findModel( $id )->delete();
        return $this->redirect(['index']);
    }

    /**
     * Promo User Login
     *
     * @return string|\yii\web\Response
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the PromoCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PromoCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id ) {
        if( ( $model = PromoCode::findOne( $id ) ) !== null ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
