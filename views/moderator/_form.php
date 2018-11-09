<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Moderator;
use yii\data\ActiveDataProvider;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Moderator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moderator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $user = new Moderator();
     ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'id'=>'pas']) ?>

<!--     <?= Html::Button('Показать пароль',['onclick'=>'show_pas()','id'=>'btn_show_pas']) ?> -->

    <?= $form->field($model, 'role')->radioList(array(1 => 'Модератор', 10 => 'Администратор'), array('labelOptions'=>array('style'=>'display:inline-block;margin-right:100px'))); 
    ?>

    <?php
	   	$user->generateAuthKey();
	   	//$user->setPassword($pass);
     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<!--     <script type="text/javascript">
        function show_pas() {
            var pas_input = document.getElementById("pas");
            var pas_btn = document.getElementById("btn_show_pas");
            pas_input.getAttribute("type") == "password" ? pas_input.setAttribute("type","text") : pas_input.setAttribute("type","password");
            
        }
        
    </script> -->

</div>
