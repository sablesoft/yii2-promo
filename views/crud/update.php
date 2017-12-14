<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model testwork\promo\models\PromoCode */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Promo Code' ]) . $model->code;
$this->params['breadcrumbs'][] =
    ['label' => Yii::t('app', 'Promo Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] =
    ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="promo-code-update">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'action' => 'update'
    ]) ?>

</div>
