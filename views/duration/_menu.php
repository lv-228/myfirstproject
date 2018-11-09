<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;

echo Nav::widget([
		'options' => ['class' => 'nav nav-tabs'],
		'items' => [
		['label' => 'Рекламодатель',
		'url' => ['advertiser/create']],
		['label' => 'Баннер',
		'url' => ['banner/create']],
		['label' => 'Период показа',
		'url' => ['duration/create']],
		]
		]);