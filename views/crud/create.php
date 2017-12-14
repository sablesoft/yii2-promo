<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model testwork\promo\models\PromoCode */

$this->title = Yii::t('app', 'Create Promo Code');
$this->params['breadcrumbs'][] =
    ['label' => Yii::t('app', 'Promo Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="promo-code-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'action' => 'create'
    ]) ?>

</div>
