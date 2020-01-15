<style>
  td{
    font-size: 1.2vw !important;
  }
  tr td span{
    color: red;
  }
</style>
<div class="silver-bk justify-content-center">
  <div class="row justify-content-center">
    <div class="col-9 justify-content-center">
      <div class="indexx">
        <span>Список Игроков</span>
      </div>
    </div>
    <div class="col-11 justify-content-center inde"> 
<?PHP
$_OPTIMIZATION["title"] = "Пользователи";
$_OPTIMIZATION["description"] = "Управление пользователями системы";

# Редактирование пользователя
if(isset($_GET["edit"])){

$eid = intval($_GET["edit"]);

$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");

# Проверяем на существование
if($db->NumRows() != 1){ echo "<center><b>Указанный пользователь не найден</b></center><BR />"; }

# Добавляем дерево
if(isset($_POST["set_tree"])){

$tree = $_POST["set_tree"];
$type = ($_POST["type"] == 1) ? "-1" : "+1";
$arr = array(
  "a_t" => "Чайки", 
  "b_t" => "Рыбаки Михалычи",
  "с_t" => "Александры Рыбаки"
  );
        $timme = time();
  $db->Query("UPDATE db_users_b SET {$tree} = '0' WHERE id = '$eid'");
  $db->Query("DELETE FROM db_product_time WHERE `id_user` = '$eid' AND `name` = '$tree' AND `date_del` > '$timme' ");
$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
  echo "<center><b>Удалены все ".$arr["$tree"]." и удалены записи с временем жизни.</b></center>";
  
}


# Пополняем баланс
if(isset($_POST["balance_set"])){

$sum = intval($_POST["sum"]);
$suminsert = $sum/100;
$bal = $_POST["schet"];
$type = ($_POST["balance_set"] == 1) ? "-" : "+";

# Реферальные + рефбек
$db->Query("SELECT * FROM db_users_a WHERE id = '$eid' LIMIT 1");
   $user_ardata = $db->FetchArray();
$user_name = $user_ardata["user"];
   $refid = $user_ardata["referer_id"];
$db->Query("SELECT * from db_users_a WHERE id='$refid'"); 
$rf_data=$db->FetchArray(); 
$refback=$rf_data["refback"]/100;
$to_r = ($sum * 0.05);


$to_referer_rb = 0; 
$to_referer = $to_r;
/* Для Включения авторефбека верхние строчки закомментировать эти активировать
$to_referer_rb = ($to_r*$refback); 
$to_referer = $to_r - $to_referer_rb; */

$string = ($type == "-") ? "У пользователя снято {$sum} $" : "Пользователю добавлено {$sum} $";

  
  if ($_POST["balance_set"] == 2 && $_POST["schet"] == "money_b") {
    # 1  Реферер делает игроку рефбек. Игроку зачисляется рефбек 
    $db->Query("UPDATE db_users_b SET money_b=money_b+$to_referer_rb, refback_recieved=refback_recieved+$to_referer_rb, to_referer = to_referer + '$to_referer' where id='$eid'");
    $db->Query("UPDATE db_users_b SET money_p = money_p + $to_referer, from_referals = from_referals + '$to_referer' WHERE id = '$refid'");
  }
  $db->Query("UPDATE db_users_b SET {$bal} = {$bal} {$type} {$sum} WHERE id = '$eid'");
  $db->Query("UPDATE db_users_b SET insert_sum = insert_sum {$type} '$suminsert' WHERE id = '$eid'");
  $db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
  echo "<center><b>$string</b></center><BR />";
  
}


# Забанить пользователя
if(isset($_POST["banned"])){

  $db->Query("UPDATE db_users_a SET banned = '".intval($_POST["banned"])."' WHERE id = '$eid'");
  $db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
  echo "<center><b>Пользователь ".($_POST["banned"] > 0 ? "забанен" : "разбанен")."</b></center><BR />";
  
}

$data = $db->FetchArray();

?>
<br/>
<table class="table table-striped" border="0">
  <tr>
     
  </tr>
  <tr>
  <tr>
    <td>ID:</td>
    <td><?=$data["id"]; ?></td>
  </tr>
  <tr>
    <td>Логин:</td>
    <td><?=$data["user"]; ?></td>
  </tr>
  <?php
  $db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a WHERE ip IN (SELECT ip FROM db_users_a GROUP BY ip HAVING COUNT(*) > 1) AND ip = $data[ip] AND id != $data[id] ");
  if($db->NumRows()>0) {
    while($mult = $db->FetchArray()) {
      echo '<tr>
      <td><b>Мульт:</b></td>
      <td>';
      echo '<a href="/?menu=mo4cloud&sel=users&edit='.$mult['id'].'"';
      if($mult['banned']==1) { 
        echo ' style="color: red;"';
      }
      echo '>'.$mult["user"].'</a>';
      echo '</td>
      </tr>';
    }
  }
  ?>
  <?php 
  # Модуль изменения реферала по ID 
  if(isset($_POST["idref"])){
  $refchange = $_POST["idref"]; 
  $db->Query("SELECT * FROM db_users_a WHERE id = '$refchange' LIMIT 1");
  $reeff = $db->FetchArray();
  $newrefname = $reeff['user'];
  $db->Query("UPDATE db_users_a SET referer = '$newrefname', referer_id = '$refchange'  WHERE id = '$eid'");
  echo '<font color = "green">Вы успешно поменяли реферала на: ', $newrefname,'</font>' ;
} ?>
<?php 
  # Модуль изменения реферального бонуса
  if(isset($_POST["adrefb"])){
  $refbonuss = $_POST["adrefb"];
  $db->Query("UPDATE db_users_a SET add_ref_bonus = '$refbonuss'  WHERE id = '$eid'");
  echo '<font color = "green">Вы успешно поменяли рефбонус на : ', $refbonuss,'</font>' ;
} ?>
  <tr>
    <td>Email:</td>
    <td><?=$data["email"]; ?></td>
  </tr>
  <tr>
    <td>Пароль:</td>
    <td><?=$data["pass"]; ?></td>
  </tr>
  <tr>
    <td>На покупки:</td>
    <td><?=sprintf("%.2f",$data["money_b"]); ?></td>
  </tr>
  
  <tr>
    <td>На вывод:</td>
    <td><?=sprintf("%.2f",$data["money_p"]); ?></td>
  </tr>
  
<!--   <tr>
  <td>G/h на складе 1 тарифу Bitcloud</td>
  <td><?=$data["a_b"]; ?></td>
</tr>
<tr>
  <td>G/h на складе 2 тарифу Bitcloud</td>
  <td><?=$data["b_b"]; ?></td>
</tr>
<tr>
  <td>G/h на складе 3 тарифу Bitcloud</td>
  <td><?=$data["c_b"]; ?></td>
</tr> -->
  

  <tr>
    <td>Куплено G/h по 1 тарифу Bitcloud</td>
    <td>Куплено: <?=$data["a_t"]; ?> G/h
      <form action="" method="post">
        <input type="hidden" name="set_tree" value="a_t" />
        <input type="hidden" name="type" value="1" />
        <input type="submit" value="Удалить все" />
      </form>
  </td>
  </tr>

<!--   <tr>
  <td>Куплено G/h по 2 тарифу Bitcloud</td>
  <td>Куплено: <?=$data["b_t"]; ?> шт.
    <form action="" method="post">
      <input type="hidden" name="set_tree" value="b_t" />
      <input type="hidden" name="type" value="1" />
      <input type="submit" value="Удалить все" />
    </form>
</td>
</tr>

<tr>
  <td>Куплено G/h по 3 тарифу Bitcloud</td>
  <td>Куплено: <?=$data["c_t"]; ?> шт.
    <form action="" method="post">
      <input type="hidden" name="set_tree" value="c_t" />
      <input type="hidden" name="type" value="1" />
      <input type="submit" value="Удалить все" />
    </form>
</td>
</tr> -->

  </tr>

  <tr>
    <td>Собрано G/H по 1 тарифу Bitcloud:</td>
    <td><?=$data["all_time_a"]; ?> G/h <span >(<?=round($data["all_time_a"]/100000,2); ?> $)</span></td>
  </tr>
<!--   <tr>
  <td>Собрано G/H по 1 тарифу Bitcloud:</td>
  <td><?=$data["all_time_b"]; ?>G/h</td>
</tr>
<tr>
  <td>Собрано G/H по 1 тарифу Bitcloud:</td>
  <td><?=$data["all_time_c"]; ?>G/h</td>
</tr> -->
  <tr>
    <td>Referer[Пригласил в игру]:</td>
    <td>[<?=$data["referer_id"]; ?>]<?=$data["referer"]; ?>
    <form action="" method="post">
    <input type="text" name="idref" class="idre" placeholder="номер id"><button type="submit" class="serrf">Изменить</button></form></td>
    
  </tr>
  <tr>
    <td>Добавить реферальный бонус:</td>
    <td>Сейчас установлен бонус: <?=$data["add_ref_bonus"]; ?>
    <form action="" method="post">
    <input type="text" name="adrefb" class="idre" placeholder="<?=$data["add_ref_bonus"]; ?>"><button type="submit" class="serrf">Изменить</button></form></td>
    
  </tr>
  <tr>
    <td>Рефералов:</td>
  
  <?PHP
  $db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$data["id"]."'");
  $counter_res = $db->FetchRow();
  ?>
  
    <td><?=$data["referals"]; ?> [<?=$counter_res; ?>] чел.</td>
  </tr>
  
  <tr>
    <td>Заработал на рефералах:</td>
    <td><?=sprintf("%.2f",$data["from_referals"]); ?> $</td>
  </tr>
  <tr>
    <td>Принес рефереру:</td>
    <td><?=sprintf("%.2f",$data["to_referer"]); ?> $</td>
  </tr>
  
  
  
  <tr>
    <td>Зарегистрирован:</td>
    <td><?=date("d.m.Y в H:i:s",$data["date_reg"]); ?></td>
  </tr>
  <tr>
    <td>Последний вход:</td>
    <td><?=date("d.m.Y в H:i:s",$data["date_login"]); ?></td>
  </tr>
  <tr>
    <td>Последний IP:</td>
    <td><?=$data["uip"]; ?></td>
  </tr>
  
  
  <tr>
    <td>Пополнено на баланс:</td>
    <td><?=sprintf("%.2f",$data["insert_sum"]); ?> <?=$config->VAL; ?>$</td>
  </tr>
  <tr>
    <td>Выплачено на кошелек:</td>
    <td><?=sprintf("%.2f",$data["payment_sum"]); ?> <?=$config->VAL; ?>$</td>
  </tr>
  
  <tr>
    <td>Забанен (<?=($data["banned"] > 0) ? '<font color = "red"><b>ДА</b></font>' : '<font color = "green"><b>НЕТ</b></font>'; ?>):</td>
    <td>
  <form action="" method="post">
  <input type="hidden" name="banned" value="<?=($data["banned"] > 0) ? 0 : 1 ;?>" />
  <input type="submit" class="btn btn-info" value="<?=($data["banned"] > 0) ? 'Разбанить' : 'Забанить'; ?>" />
  </form>
  </td>
  </tr>
  <?php 
  # Забанить кошелек Payeer
if(isset($_POST["bann_payeer"])){

  $db->Query("UPDATE db_users_b SET payeer_off = '".intval($_POST["bann_payeer"])."' WHERE id = '$eid'");
 
  echo "<center><b>Кошелек Payeer ".($_POST["bann_payeer"] > 0 ? "Заблокирован" : "Разблокирован")."</b></center><BR />";
}
# Забанить кошелек PerfectMoney
if(isset($_POST["bann_perf"])){

  $db->Query("UPDATE db_users_b SET perfect_off = '".intval($_POST["bann_perf"])."' WHERE id = '$eid'");
  echo "<center><b>Кошелек PerfectMoney ".($_POST["bann_perf"] > 0 ? "Заблокирован" : "Разблокирован")."</b></center><BR />"; 
} 
# Забанить кошелек Ручные выплаты
if(isset($_POST["bann_hand"])){

  $db->Query("UPDATE db_users_b SET hand_off = '".intval($_POST["bann_hand"])."' WHERE id = '$eid'");
  echo "<center><b>Ручные выплаты ".($_POST["bann_hand"] != 0 ? "Заблокированы" : "Разблокированы")."</b></center><BR />"; 
}
?>
<!--   <tr>
  <td>Payeer: <?=$data["payeer_wallet"]?> Заблокирован(<?=($data["payeer_off"] > 0) ? '<font color = "red"><b>ДА</b></font>' : '<font color = "green"><b>НЕТ</b></font>'; ?>):</td>
  <td>
  <form action="" method="post">
<input type="hidden" name="bann_payeer" value="<?=($data["payeer_off"] > 0) ? 0 : 1 ;?>" />
<input type="submit" class="btn btn-info" value="<?=($data["payeer_off"] > 0) ? 'Разблокировать' : 'Заблокировать'; ?>" />
</form>
</td>
</tr> -->
  <tr>
    <td>PerfectMoney: <?=$data["perfect_wallet"]?> Заблокирован(<?=($data["perfect_off"] > 0) ? '<font color = "red"><b>ДА</b></font>' : '<font color = "green"><b>НЕТ</b></font>'; ?>):</td>
    <td>
    <form action="" method="post">
  <input type="hidden" name="bann_perf" value="<?=($data["perfect_off"] > 0) ? 0 : 1 ;?>" />
  <input type="submit" class="btn btn-info" value="<?=($data["perfect_off"] > 0) ? 'Разблокировать' : 'Заблокировать'; ?>" />
  </form>
</td>
  </tr>
 <!--    <tr>
 <td>QIWI: <?=$data["qiwi_wallet"]?> ADV: <?=$data["adv_wallet"]?> Заблокирован(<?=($data["hand_off"] > 0) ? '<font color = "red"><b>ДА</b></font>' : '<font color = "green"><b>НЕТ</b></font>'; ?>):</td>
 <td>
 <form action="" method="post">
   <input type="hidden" name="bann_hand" value="<?=($data["hand_off"] > 0) ? 0 : 1 ;?>" />
   <input type="submit" class="btn btn-info" value="<?=($data["hand_off"] > 0) ? 'Разблокировать' : 'Заблокировать'; ?>" />
   </form>
 </td>
   </tr> -->
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><b>Операции с балансом:</b></td>
  </tr>
  
    <form action="" method="post">
  <tr>
    <td>
    <select name="balance_set" style="display: block !important;">
      <option value="2">Добавить на баланс</option>
      <option value="1">Снять с баланса</option>
    </select>
  </td>
  <td>
    <select name="schet" style="display: block !important;">
      <option value="money_b">Для покупок</option>
      <option value="money_p">Для вывода</option>
    
    </select>
  </td>
</tr>
<tr>
    <td><input type="text" name="sum" value="100" size="7"/></td>
    <td><input type="submit" value="Выполнить" class="btn btn-warning" /></td>
</tr>
</form>  
</table>
</div><br><br>
</div
                <div class="clr"></div>
</div>


<?PHP

return;
}

?>

<hr/>
<form action="/?menu=mo4cloud&sel=users&search" method="post" class="form-search">
<div class="input-append">
    <input type="text" name="sear" class="span12 search-query" placeholder="Логин">
    <button type="submit" class="serf2">Найти</button>
</div>
</form>
<hr/>
<?PHP

function sort_b($int_s){
  
  $int_s = intval($int_s);
  
  switch($int_s){
  
    case 1: return "db_users_a.user";
    case 2: return "all_serebro";
    case 3: return "all_trees";
    case 4: return "db_users_a.date_reg";
  //  case 5: return "db_users_a.email"; // убрал сортировку по мылу
    case 6: return "db_users_a.rsite";
    case 7: return "db_users_a.referer";
    case 8: return "db_users_b.insert_sum";
    case 9: return "db_users_b.payment_sum";
    
    default: return "db_users_a.id";
  }

}
$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;

$str_sort = sort_b($sort_b);


$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
$lim = $num_p * 100;

if(isset($_GET["search"])){
$search = $_POST["sear"];
$db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro 
FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.user = '$search' ORDER BY {$str_sort} DESC LIMIT {$lim}, 100");

}else $db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro 
FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id ORDER BY {$str_sort} DESC LIMIT {$lim}, 100");



if($db->NumRows() > 0){

?>
<table border='0' class="table table-striped">
  <tr>
    <td><a href="/?menu=mo4cloud&sel=users&sort=0"><b>ID</b></a></td>
    <td><a href="/?menu=mo4cloud&sel=users&sort=1"><b>Юзер</b></a></td>
   
  <td><a href="/?menu=mo4cloud&sel=users&sort=7"><b>Привел</b></a></td>
  <td><a href="/?menu=mo4cloud&sel=users&sort=8"><b>Донат</b></a></td>
  <td><a href="/?menu=mo4cloud&sel=users&sort=9"><b>Вывел</b></a></td>
    <td><a href="/?menu=mo4cloud&sel=users&sort=2"><b>Монет</b></a></td>
  <td><a href="/?menu=mo4cloud&sel=users&sort=3"><b>Раст.</b></a></td>
  <td><a href="/?menu=mo4cloud&sel=users&sort=4"><b>Зареган</b></a></td>
  </tr>


<?PHP

  while($data = $db->FetchArray()){
  
  ?>
  <tr>
    <td><?=$data["id"]; ?></td>
    <td><a href="/?menu=mo4cloud&sel=users&edit=<?=$data["id"]; ?>" class="stn"><?=$data["user"]; ?></a><br/><?=$data["email"]; ?></td>
   
  <td><?=$data["referer"]; ?></td>
  <td><?=sprintf("%.2f",$data["insert_sum"]); ?></td>
  <td><?=sprintf("%.2f",$data["payment_sum"]); ?></td>
    <td><?=sprintf("%.2f",$data["all_serebro"]); ?></td>
  <td><?=$data["all_trees"]; ?></td>
  <td><?=date("d.m.Y",$data["date_reg"]); ?></td>
    </tr>
  <?PHP
  
  }

?>

</table>
<BR />
<?php 
if(!isset($_GET["search"])){
$db->Query("SELECT COUNT(*) FROM db_users_a");
$all_pages = $db->FetchRow();

  if($all_pages > 100){
  
  $sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
  
  $nav = new navigator;
  $page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
  
  echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 100), "/?menu=mo4cloud&sel=users&sort={$sort_b}&page="), "</center>";
  
  } 
}
?>
</div></div>
<div class="clr"></div> 
<?PHP


}else echo "<center><b>На данной странице нет записей</b></center><BR />";

  if(isset($_GET["search"])){
  
  return;
  
  }
  

?>

</div>
</div>
<div class="clr"></div> 