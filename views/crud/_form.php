<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $action string */
/* @var $this yii\web\View */
/* @var $model testwork\promo\models\PromoCode */
/* @var $form yii\widgets\ActiveForm */

$lang = Yii::$app->language;

?>

<div class="promo-code-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if( !!$model->status || $action === 'create' ): ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'reward')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'zone_id')->dropDownList( $model->zones ); ?>
    <?= $form->field( $model, 'active_from' )->widget(
            DatePicker::classname(), [
                'language' => $lang,
                'dateFormat' => 'yyyy-MM-dd'
            ]);
    ?>
    <?= $form->field( $model, 'active_until' )->widget(
            DatePicker::classname(), [
                'language' => $lang,
                'dateFormat' => 'yyyy-MM-dd'
            ]);
    ?>
    <?php endif; ?>
    <?= $form->field($model, 'status')->checkbox(['label' => 'Enabled'], false ); ?>

    <div class="form-group">
        <?= Html::submitButton(
                $model->isNewRecord ?
                    Yii::t('app', 'Create') :
                    Yii::t('app', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
