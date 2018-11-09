<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'advertiser_id')->dropDownList(ArrayHelper::map(app\models\Advertiser::find()->andWhere('id>0')->all(), 'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
