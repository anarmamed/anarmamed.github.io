<?php 


$db->Query("SELECT COUNT(*) FROM db_payment WHERE status = '0'");
$allpaym = $db->FetchRow();
$db->Query("SELECT COUNT(*) FROM db_hand_insert WHERE status = '1'");
$allinse = $db->FetchRow();

$db->Query("SELECT COUNT(*) FROM  `db_users_a` WHERE `satana` >= '6' AND`banned` = '0' ");
$satan = $db->FetchRow();


 ?>
   <div class="container-fluid header1">
  <div class="row  ml-0 mr-0 justify-content-center content">
  	
   <div class="col-2 center-block cl-left">	
	<div class="user-menu">
	<div class="field-gr"><a href="/?menu=mo4cloud&sel=stats">Статистика</a></div>
	<div class="field-gr"><a href="/?menu=mo4cloud&sel=story_insert">Пополнения</a></div>
	<div class="field-gr"><a href="/?menu=mo4cloud&sel=payments2">Выводы</a></div>
	<div class="field-gr"><a href="/?menu=mo4cloud&sel=users">Пользователи</a></div>
	<div class="field-gr"><a href="/?menu=mo4cloud&sel=news">Новости</a></div>


 


 
	</div>	