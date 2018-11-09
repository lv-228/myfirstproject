<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;


/* @var $this yii\web\View */
/* @var $model app\models\Duration */

$this->title = 'Период показа';
$this->params['breadcrumbs'][] = ['label' => 'Durations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duration-create">
	<?= $this->render('_menu')?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
