<?php

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = 'Update Banner: ' . $model->link;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$model = new Banner();

if (Yii::$app->request->isPost) {
$model->image = UploadedFile::getInstance($model, 'image');
if ($model->upload()) {
// file is uploaded successfully
return;
}
}
?>
<div class="banner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>