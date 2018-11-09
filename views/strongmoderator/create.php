<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Strongmoderator */

$this->title = 'Зарегистрировать супермодератора';
$this->params['breadcrumbs'][] = ['label' => 'Strongmoderators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strongmoderator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
