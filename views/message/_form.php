<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->radioList(array('_' => 'Обычные', 'important' => 'Важные', 'most-important' => 'Очень важные',), array('labelOptions'=>array('style'=>'display:inline-block;margin-right:10px'))); 
            ?>

    <?= $form->field($model, 'date_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trans_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
