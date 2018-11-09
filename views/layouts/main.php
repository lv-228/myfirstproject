<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Translation;
use app\models\Moderator;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head> 
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        
        if(isset($_SESSION)){

        NavBar::begin([
            'brandLabel' => $_SESSION['transname'],
            'brandUrl' => '/'.$_SESSION['thistrans'],
            'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
         ],
        ]);
        }
        else NavBar::begin([
            'brandLabel' => "Трансляции",
            'brandUrl' => 'http://dota.geos.tom.ru:2180',
            'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);

    if(isset(Yii::$app->user->identity)&&Moderator::isUserAdmin(Yii::$app->user->identity->login)){
        echo $this->render('adminnav');    
    }

    else {
    echo $this->render('modernav');
    }
        ?>
        
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
    <?= $this->render('modalwindow') ?>
</div>
<!-- 
<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>

        <p class="pull-right"></p>
    </div>
</footer> -->
<?php $kostil_id = json_encode($_SESSION['thistransid']);
    echo "<script>
            var kostil = ".$kostil_id."
          </script>";
?>

<script type="text/javascript" src="js/layout.js">
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>