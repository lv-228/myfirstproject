<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Команды';
$this->params['breadcrumbs'][] = $this->title;

if(Yii::$app->session->getFlash('successID'))    
    echo Alert::widget([
        'options' => [
            'class' => 'alert alert-danger',
        ],
        'body' => Yii::$app->session->getFlash('successID'),
    ]);
?>
<div class="team-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать команду', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'logo',
            [
                    'attribute' => 'logo',
                    'label'     => 'Логотип',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return Html::a(
                                Html::img(\yii\helpers\Url::toRoute($model->logo), ['alt'=>'myImage','width'=>'100','height'=>'100']),
                                yii\helpers\Url::toRoute($model->logo),
                                [
                                        'target' => 'blank'
                                ]
                            )
                            ;
                    }
            ],
            'win_score',
            'lose_score',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
