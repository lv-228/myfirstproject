<?php 
use app\models\Translation;

$listtrans = Translation::find()->where(['delete'=>false])->orderBy('data_create DESC')->all();

$thistranssql = Translation::find()->where(['delete'=>false])->andWhere(['id'=>$_SESSION['thistransid']])->orderBy('data_create DESC')->asArray()->one();

$listtrans_off = Translation::find()->where(['delete'=>true])->limit('15')->orderBy('data_create DESC')->all();