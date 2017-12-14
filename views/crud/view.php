<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model testwork\promo\models\PromoCode */

$this->title = $model->code;
$this->params['breadcrumbs'][] =
    ['label' => Yii::t('app', 'Promo Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-code-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
                Yii::t('app', 'Update'),
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']
        ); ?>
        <?= Html::a(
                Yii::t('app', 'Delete'),
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' =>
                            Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post'
                    ]
                ]
        ); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            [
                'attribute' => 'reward',
                'format'    => [ 'decimal', 2 ]
            ],
            'zoneName',
            'active_from:date',
            'active_until:date',
            [
                'attribute' => 'status',
                'value' => $model->statusName
            ]
        ]
    ]) ?>

</div>
