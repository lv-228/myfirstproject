<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Duration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="duration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'clicks_numbers')->textInput() ?>

    <?= $form->field($model, 'show_numbers')->textInput() ?>

    <?= $form->field($model, 'banner_id')->dropDownList(ArrayHelper::map(app\models\Banner::find()->andWhere('id>0')->all(), 'id','image')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
