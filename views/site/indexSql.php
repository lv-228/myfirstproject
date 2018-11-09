<?php

	$chosetrans = Translation::find()->where(['id'=> (int)$_GET['trans_id']])->one();

    $_SESSION['transname'] = $chosetrans->name;

    $listmess = Message::find()->where(['trans_id' => (int)$_GET['trans_id']])->orderBy(['(date_time)' => SORT_ASC])->all();

    $all_heroes = Hero::find()->asArray()->all();

    $_SESSION['transname'] = $chosetrans->name;

    $_SESSION['thistrans'] = '?trans_id='.(int)$_GET['trans_id'];

    $_SESSION['thistransid'] = (int)$_GET['trans_id'];

    $team_players_a = Player::find()->where('team_id' == $chosetrans->team_a_id)->all();
	
	$team_a = $chosetrans->teama['name'];

    $team_b = $chosetrans->teamb['name'];