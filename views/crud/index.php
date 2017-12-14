<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
use yii\grid\SerialColumn;

/* @var $this yii\web\View */
/* @var $searchModel testwork\promo\models\PromoCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Promo Codes');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="promo-code-index">

    <h1>
        <?= Html::encode( $this->title ); ?>
    </h1>

    <p>
        <?= Html::a(
                Yii::t('app', 'Create Promo Code'),
                ['create'],
                ['class' => 'btn btn-success']
        ); ?>
    </p>
    <?php Pjax::begin([
            'timeout' => false,
            'enablePushState' => false,
            'clientOptions' => ['method' => 'POST']
        ]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => SerialColumn::className() ],
                'id',
                'code',
                [
                    'attribute' => 'reward',
                    'format'    => [ 'decimal', 2 ]
                ],
                [
                    'attribute' => 'zone_id',
                    'value'     => 'zoneName',
                    'filter'    => $searchModel->zones
                ],
                [
                    'attribute' => 'active_from',
                    'value'     => 'active_from',
                    'filter'    => DatePicker::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'active_from',
                                    'language' => Yii::$app->language,
                                    'dateFormat' => 'dd-MM-yyyy'
                                ]),
                    'format'    => 'date',
                ],
                [
                    'attribute' => 'active_until',
                    'value'     => 'active_until',
                    'filter'    => DatePicker::widget([
                                    'model' => $searchModel,
                                    'attribute' => 'active_until',
                                    'language' => Yii::$app->language,
                                    'dateFormat' => 'dd-MM-yyyy'
                                ]),
                    'format'    => 'date',
                ],
                [
                    'attribute' => 'status',
                    'value' => function( $model ) {
                        /** @var \testwork\promo\models\PromoCode $model */
                        return $model->statusName;
                    },
                    'filter'    => $searchModel->statuses
                ],
                [ 'class' => 'yii\grid\ActionColumn' ]
            ]
        ]); ?>
    <?php Pjax::end(); ?>

</div>
