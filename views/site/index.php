<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\widgets\Pjax;
    use yii\grid\GridView;
    use yii\bootstrap\Nav;
    use yii\bootstrap\Collapse;
    use app\assets\AppAsset;
    use app\models\Translation;
    use app\models\Player;
    use app\models\Hero;
    use app\models\Message;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\Modal;
    use yii\web\JqueryAsset;
    /* @var $this yii\web\View */
    $this->title = 'Трансляция';
    
    $SQL = Translation::indexSql();

    $chosetrans = $SQL['chosetrans'];  
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
    crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <div class="container-fluide content">
    <div class="row my-row">
      <div class="col-lg-1 col-md-1"></div>
      <div class="col-lg-3 col-md-3">
        <div class="input-group">
         <div class="input-group-btn">
          <?php

          $score_a = $SQL['chosetrans']['team_a_score'];
                if(!isset($_GET['scorea'])){
                  $_GET['scorea'] = 0;
                }
           ?>

              <a id="scorea_button" class='btn btn-default' href='#' onclick='validateFormA()';><?=$score_a?></a>

              <?php Modal::begin([
                      'header' => $SQL['chosetrans']->teama['name'],
                      'toggleButton' => [
                          'tag' => 'button',
                          'id' => 'modal_a',
                          'class' => 'btn btn-success dropdown-toggle',
                          'label' => $SQL['chosetrans']->teama['name'],
                      ]
                  ]);

                $form = ActiveForm::begin(['action' => 'translation/updateteama', 'id' => 'teama_post', 'method' => 'post']);
                ?>

                <?= $form->field($SQL['chosetrans'], 'team_a_id',[
                  'inputOptions'=>[
                    'id'=>'team_chose',
                    'class'=>'form-control',
                    'onchange' => 'this.form.submit()',
                    ]
                  ])->dropDownList(ArrayHelper::map(app\models\Team::find()->andWhere("id<>$chosetrans->team_b_id")->all(), 'id','name')) ?>

                  <input type="hidden" name="trans_id" value='<?php echo $_GET['trans_id']; ?>'>
                  <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>">

                  <?php ActiveForm::end();?>
                  <?php $i=0;$j=0; foreach ($SQL['team_players_a'] as $k => $player): ?>
                    <?php  if($player->team_id == $SQL['chosetrans']->team_a_id):?>
                    <form action="player/updateplayer" method="post">
                      <div class='input-group'>
                        <input value='<?= "$player->nick" ?>' type='text' class='form-control' name='player_nick[<?=$j?>]'>
                        <span class='input-group-btn my-input-group'>
                        <button class='btn btn-default' type='button'><span class='glyphicon glyphicon-picture'></span></button>
                        </span>
                        <select type="text" class="form-control" placeholder="Герой 1" name="hero_id[<?=$j?>]">
                          <?php

                           for ($k=0; $k <count($SQL['all_heroes']); $k++) { 
                            ($player->hero_id == $SQL['all_heroes'][$k]['id']) ? $select = " selected" : $select = '';

                            echo "<option value=".$SQL['all_heroes'][$k]['id'].$select. ">";
                            echo $SQL['all_heroes'][$k]['name']."</option>";
                          } ?>
                        </select>
                        <span class='input-group-btn my-input-group'>
                          <button class='btn btn-default' type='button'><span class='glyphicon glyphicon-picture'></span></button>
                          </span>
                      </div>
                      <input type='hidden' name='player_hidden[<?=$i?>]' value='<?=$player->id?>'>
                      <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>">
                      <?php $i++;$j++; ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
              <p> </p>
              <?php if($SQL['chosetrans']->delete == false)
               echo Html::submitButton('Подтвердить',['class' => 'btn btn-success']); 
              ?>
            </form>
              <?php
                  Modal::end();
              ?>
         </div>
        <form id='scoreform1' method="post" action="">
         <input type="hidden" name="trans_id" value='<?php echo $_GET['trans_id']; ?>'>
          <?php if($SQL['chosetrans']->delete == false): ?>
            <input id='score_teama' name='scorea' type="text" class="form-control moz kostil2" aria-label="..." placeholder="Radiant" required="">
          <?php endif; ?>
         <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>">
        </form> 
      </div>
      </div>

      <div class="col-lg-1 col-md-1"></div>
      <div class="col-lg-3 col-md-3">
        <div class="input-group">
<!--           <input type="text" class="form-control" placeholder="Поиск по сообщениям">
          <span class="input-group-btn">
          <button class="btn btn-default" type="button">Go!</button> -->
          </span>
        </div>
      </div>
      <div class="col-lg-3 col-md-3">
        <div class="input-group">
         <div class="input-group-btn">
           <?php 
                $score_b = $SQL['chosetrans']['team_b_score'];
                if(!isset($_GET['scoreb'])){
                  $_GET['scoreb'] = 0;
                }
               ?>

               <a id="scoreb_button" class='btn btn-default' href='#' onclick='validateFormB()';><?=$score_b?></a>
              
             <?php Modal::begin([
                      'header' => $SQL['chosetrans']->teamb['name'],
                      'toggleButton' => [
                          'tag' => 'button',
                          'class' => 'btn btn-danger dropdown-toggle',
                          'label' => $SQL['chosetrans']->teamb['name'],
                      ]
                  ]);

                $form = ActiveForm::begin(['action' => 'translation/updateteamb', 'id' => 'teama_post', 'method' => 'post']);
                ?>

                <input type="hidden" name="trans_id" value='<?php echo $_GET['trans_id']; ?>'>

                <?= $form->field($SQL['chosetrans'], 'team_b_id',[
                  'inputOptions'=>[
                    'id'=>'select_b',
                    'class'=>'form-control',
                    'onchange'=>'this.form.submit()',
                    ]
                  ])->dropDownList(ArrayHelper::map(app\models\Team::find()->Where("id<>$chosetrans->team_a_id")->all(), 'id','name')) ?>

                  <?php ActiveForm::end(); ?>

                  <?php $i=0; $j=0; foreach ($SQL['team_players_b'] as $k => $layer): ?>
                    <?php  if($layer->team_id == $SQL['chosetrans']->team_b_id):?>
                    <form action="player/updateplayer" method="post">
                      <div class='input-group'>
                        <input value='<?= "$layer->nick" ?>' type='text' class='form-control' name='player_nick[<?=$i?>]'>
                        <span class='input-group-btn my-input-group'>
                        <button class='btn btn-default' type='button'><span class='glyphicon glyphicon-picture'></span></button>
                        </span>
                        <select type="text" class="form-control" placeholder="Герой 1" name="hero_id[<?=$j?>]">
                          <?php for ($h=0; $h <count($SQL['all_heroes']); $h++) {
                          ($layer->hero_id == $SQL['all_heroes'][$h]['id']) ? $select1 = " selected" : $select1 = ''; 
                            echo "<option value=".$SQL['all_heroes'][$h]['id'].$select1. ">";
                            echo $SQL['all_heroes'][$h]['name']."</option>";
                          } ?>
                        </select>
                        <span class='input-group-btn my-input-group'>
                          <button class='btn btn-default' type='button'><span class='glyphicon glyphicon-picture'></span></button>
                          </span>
                          <!-- <input type='text' class='form-control my-input-text' placeholder='КДА'> -->
                      </div>
                      <input type='hidden' name='player_hidden[<?=$i?>]' value='<?=$layer->id?>'>
                      <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>">

                      <?php $i++;$j++; ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
              <p> </p>
              <?php if($SQL['chosetrans']->delete == false)
              echo Html::submitButton('Подтвердить',['class' => 'btn btn-success']); ?>
                        ?>
            </form>

              <?php
                  Modal::end();
              ?>
           </div>
           <form id='scoreform2' method="post" action="">
             <input type="hidden" name="trans_id" value='<?php echo $_GET['trans_id']; ?>'>
             <?php if($SQL['chosetrans']->delete == false): ?>
                <input id='score_teamb' name='scoreb' type="text" class="form-control moz kostil2" aria-label="..." placeholder="Dier" required="">
              <?php endif; ?>
             <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>">
            </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-1 col-md-1"></div>
      <div class="col-lg-1 col-md-1">
      </div>
      <div class="col-lg-8 col-md-8">
        <?php Pjax::begin(['id' => 'my-pjax']); ?>
        <script type="text/javascript">
          var textscroll = document.getElementById("text_scroll");
          textscroll.scrollTop = textscroll.scrollHeight;
        </script>
        <div class="pre-scrollable" id="text_scroll">
        <ul class="list-group">
          <?php foreach ($SQL['listmess'] as $key => $val): ?>
          <?php $vajnost = $val->type; ?>
            <li class="list-group-item"> <span class="badge del"><a href=<?php echo "message/delete?id=$val->id"?> onclick="this.setAttribute('style','display:none')" class="glyphicon glyphicon-trash"></a></span><span class="badge redac"><form method="POST" name="mesage_form_id" id="id_mes<?=$val->id?>" action=""><input type="hidden" name="mes_content" value="<?php echo $val->content; ?>"><input type="hidden" name="mes_id" value="<?php echo $val->id; ?>"><input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>"><a href="#" class="glyphicon glyphicon-pencil" id="update_message" onclick="sendAjaxForm('result_form', 'id_mes<?=$val->id?>', 'site/updatemodal')"></a></form></span> <span <?php echo "class='badge $val->type'" ?>><?= $val->date_time ?></span><?= $val->content ?></li>
          <?php endforeach; ?>
        </ul>
        </div>
        <?php Pjax::end(); ?>
      </div>
      <div class="col-lg-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-2"></div>
      <div class="col-lg-8 col-md-8">
        <?php if($SQL['chosetrans']->delete == false):  ?>
        <?php Pjax::begin(['id' => 'my-pjax']); ?> 
        <?php $form = ActiveForm::begin(['options' => ['data-pjax'=>true]]); ?>

          <?= $form->field($model, 'content')->textarea(["onkeyup" => "keyUp(event)", "onkeydown" => "keyDown(event)","id"=>"text_area_my_id","maxlength"=>"255"]); ?>

          <?php $model->type='_'; ?>

          <?= $form->field($model, 'type')->radioList(array('_' => 'Обычные', 'important' => 'Важные', 'most-important' => 'Очень важные',), array('labelOptions'=>array('style'=>'display:inline-block;margin-right:10px'))); 
            ?>
          <input type="submit" name="send-message" value="Отправить сообщение" class="btn btn-success my-input" id="my_id" onclick="clear_textarea()">
          <?php ActiveForm::end();?>
          <script type="text/javascript">
            var radio = document.querySelectorAll('#message-type > label');
            var i = 0;
            while(i<=2){
              radio[i].setAttribute("onclick","document.getElementById('text_area_my_id').focus()");
              i++;
            }

          </script>
          <?php Pjax::end(); ?>
          <?php endif; ?>
          <?php if($SQL['chosetrans']->delete == true):  ?>
            <h1 style="color:red;">Трансляция в архиве!</h1>
          <?php endif; ?>
        </form>
      </div>
      <div class="col-lg-2 col-md-2">

      </div>
  </div>

  <div id="modal_a_div">
            
  </div>
  <div id="result_form"></div> 
  <button id="wtfdude" data-toggle="modal" data-target="#redModal" class="glyphicon glyphicon-pencil" style="display: none"></button>
  </body>
<?php if($SQL['chosetrans']->delete == true)
  $this->registerJsFile(Yii::getAlias('@web/js/transdelete.js'), ['depends' => JqueryAsset::className()]);
?>
</html>