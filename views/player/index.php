<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Игроки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать игрока', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nick',
            //'icon',
            [
                    'attribute' => 'icon',
                    'label'     => 'Изображение',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return Html::a(
                                Html::img(\yii\helpers\Url::toRoute($model->icon), ['alt'=>'myImage','width'=>'100','height'=>'100']),
                                yii\helpers\Url::toRoute($model->icon),
                                [
                                        'target' => 'blank'
                                ]
                            )
                            ;
                    }
            ],
            ['attribute' => 'team_id',
           'value' => 'team.name',
           ],
           // ['attribute' => 'hero_id',
           // 'value' => 'hero.name',
           // ],
           'player_role',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
