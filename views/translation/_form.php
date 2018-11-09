<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\widgets\ActiveField;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Translation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="translation-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'team_a_id')->dropDownList(ArrayHelper::map(app\models\Team::find()->andWhere("id>0")->all(), 'id','name')) ?>

    <?= $form->field($model, 'team_b_id')->dropDownList(ArrayHelper::map(app\models\Team::find()->andWhere("id>0")->all(), 'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
