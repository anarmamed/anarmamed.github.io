<div class="silver-bk justify-content-center">
  <div class="row justify-content-center">
    <div class="col-8 justify-content-center">
      <div class="indexx">
        <span>ЗАКАЗАТЬ ВЫПЛАТУ</span>
      </div>
    </div>
    <div class="col-10 justify-content-center inde">
  
  
<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Заказ выплаты";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
  
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
  $summpay = $user_data["level"];
  $db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_dataa = $db->FetchArray();
 $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' order by id DESC LIMIT 1");
 $frompayments = $db->FetchArray();
  
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
  
$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");
  
# Минималка серебром!
$minPay = 100; 
# Настраиваем кол-во суток для ограничения.
$nd_time = 1; 

$user_id = $_SESSION["user_id"];
 $db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
if($prof_data["insert_sum"]<100) {
$status = "Ученик Рыбака";
$next = "100";
$max = "150";
} else if ($prof_data["insert_sum"]>=100 && $prof_data["insert_sum"]< 300) {
$status = "Неумелый Рыбак";
$next = "300";
$max = $prof_data["insert_sum"]*1.5;
}  else if ($prof_data["insert_sum"]>=300 && $prof_data["insert_sum"]< 700) {
$status = "Обычный Рыбак";
$next = "700";
$max = $prof_data["insert_sum"]*2;
}  else if ($prof_data["insert_sum"]>=700 && $prof_data["insert_sum"]< 2000) {
$status = "Одаренный Рыбак";
$next = "2000";
$max = $prof_data["insert_sum"]*3;
}  else if ($prof_data["insert_sum"]>=2000) {
$status = "Гений ловли рыбы";
$max = $prof_data["insert_sum"]*10;
}




if(isset($_POST["swap"])) { 
}else{
  $galla=1;
?>





<b>Выплаты осуществляются в автоматическом режиме и только на платежную систему PAYEER! Процент при выводе составляет 0%</b> 
<b>Из платежной системы Payeer Вы можете вывести свои средства в автоматическом режиме на все известные платежные системы и международные банки.</b>
<b>Ссылки на учебные материалы:</b>
  
 - <a href="http://payeer.com/?partner=182374" target="_blank">Создание счета в Payeer</a>
 - <a href="http://payeeer.ru/outpay" target="_blank">Вывод средств из payeer</a> 
  
  </br> </br>   <style type="text/css">
 .blok1
{
background: white;	
width: 100%; /* ширина блока */
border:2px dotted #cc0000;
}
 </style>
 <div class="blok1">
  </br>  <b><center>Ваш вклад: <u><font color="blue"><?=sprintf("%.2f",$prof_data["insert_sum"]); ?></u></font> рублей. &ensp;  Ваш статус: <u><font color="blue"><?=$status;?></u></font>. </br> Выплачено: <u><font color="blue"><?=round(($user_data["payment_sum"]+0.01), 2);?></u></font> рублей &ensp; из  <u><font color="blue"> <?=$max;?>   </u></font>рублей 
  </br> Доступно на вывод: <u><font color="blue"> <?=($max-0.01)-round($user_data["payment_sum"], 2);?></u></font> рублей
  
  <br></center></b> </br> 
 
  <script type="text/javascript">
function Menu(id)
{
var menu = document.getElementById('menu_' + id).style;
if (menu.display == 'none')
{
menu.display = 'block';
}
else
{
menu.display = 'none';
}
}
</script>
  <center><input type="submit" class="sumserf2" onclick="javascript:Menu('6')" value="Подробнее о статусах" style="height: 3.5vw; margin-top:10px;" /></center></br> 
<ul id="menu_6" style="display:none;">
 <center> <b><font color="blue"> Ученик Рыбака:</font> Вклад от 0 до 100 рублей. Максимум на вывод: 150 рублей.<br /><font color="blue"> Неумелый Рыбак: </font>  Вклад от 100 до 300 рублей. Максимум на вывод: 150 % от суммы вклада.<br /> <font color="blue"> Обычный Рыбак: </font>    Вклад от 300 до 700 рублей. Максимум на вывод: 200 % от суммы вклада.<br /><font color="blue"> Одаренный Рыбак: </font>  Вклад от 700 до 2000 рублей. Максимум на вывод: 300 % от суммы вклада.<br /><font color="blue">  Гений ловли рыбы:</font>   Вклад более 2000 рублей. Максимум на вывод: 1000 % от суммы вклада.</b></center></br> 
 </ul> 
 </div>  </br> 
  
<center><b>Заказ выплаты [РУБ]:</b></center>


<?PHP
}
# Заглушка минималки

if($_POST["sum"] >= 3000){

?>
<center><font color="blue"><b>Максимальная сумма для автовыплат составляет 3000 серебра!<b></font></center><BR />

<BR /><BR />
<div class="clr"></div>     
</div>
<?PHP

return;
}

?> 
  
<?PHP

$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
if($prof_data["insert_sum"]<100) {
$status = "Прохожий";
$next = "100";
$max = "150";
} else if ($prof_data["insert_sum"]>=100 && $prof_data["insert_sum"]< 300) {
$status = "Рабочий";
$next = "300";
$max = $prof_data["insert_sum"]*1.5;
}  else if ($prof_data["insert_sum"]>=300 && $prof_data["insert_sum"]< 700) {
$status = "Бригадир";
$next = "700";
$max = $prof_data["insert_sum"]*2;
}  else if ($prof_data["insert_sum"]>=700 && $prof_data["insert_sum"]< 2000) {
$status = "Мастер";
$next = "2000";
$max = $prof_data["insert_sum"]*3;
}  else if ($prof_data["insert_sum"]>=2000) {
$status = "Олигарх";
$max = $prof_data["insert_sum"]*10;
}
   
 function ViewPurse($purse){
    
  if( substr($purse,0,1) != "P" ) return false;
  if( !ereg("^[0-9]{7,8}$", substr($purse,1)) ) return false; 
  return $purse;
 }
   
 # Заносим выплату
 if(isset($_POST["purse"])){
    
  $purse = $user_data["payeer_wallet"];
  $sum = intval($_POST["sum"]);
  $summax = $max - $prof_data["payment_sum"];
  $plat_passs = intval($_POST["plat_pass"]);
    $plat_pass = $plat_passs;
  $val = "RUB";
    $moneyreting = ($sum * 0.01 / 100);
if($plat_pass == $user_dataa['plat_pass']) {
  if($purse !== false){
     
    if($sum >= $minPay){
      if (($sum/100) < $summax) {
     if($sum <= $user_data["money_p"]){
        
                            # Проверяем на существующие заявки
                        $db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
                        if($db->FetchRow() == 0){
                                 
                             ### Устанавливаем лимит на 24 часа по выплатам для $USID это формула: $nd_time * 86400
       if ($frompayments["date_add"] <= time() - $nd_time * 100) {
          
         
          
          
                            ### Делаем выплату ###   
                            $payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
                            if ($payeer->isAuth())
                            {
                                 
                                $arBalance = $payeer->getBalance();
                                if($arBalance["auth_error"] == 0)
                                {
                                     
                                    $sum_pay = round( ($sum / $sonfig_site["ser_per_wmr"]), 2);
                                     
                                    $balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
                                    if( ($balance) >= ($sum_pay)){
                                     
                                     
                                     
                                    $arTransfer = $payeer->transfer(array(
                                    'curIn' => 'RUB', // счет списания
                                    'sum' => $sum_pay, // сумма получения
                                    'curOut' => 'RUB', // валюта получения
                                    'to' => $purse, // получатель (email)
                                    //'to' => '+71112223344',  // получатель (телефон)
                                    //'to' => 'P1000000',  // получатель (номер счета)
                                    'comment' => iconv('windows-1251', 'utf-8', "Выплата пользователю: {$usname} с проекта Фабрика шоколада")
                                    //'anonim' => 'Y', // анонимный перевод
                                    //'protect' => 'Y', // протекция сделки
                                    //'protectPeriod' => '3', // период протекции (от 1 до 30 дней)
                                    //'protectCode' => '12345', // код протекции
                                    ));
                                     
                                        if (!empty($arTransfer["historyId"]))
                                        {   
                                            # Снимаем с пользователя
                                            $db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
                                             
                                            # Вставляем запись в выплаты
                                            $da = time();
                                            $dd = $da + 60*60*24*15;
                                             
                                            $ppid = $arTransfer["historyId"];
                                             
                                            $db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, payment_id, date_add, status) 
                                            VALUES ('$usname','$usid','$purse','$sum_pay','RUB', '$sum','$ppid','".time()."', '3')");
                                             
                                            $db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$sum_pay' WHERE id = '$usid'");
                                            $db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
                                             
                                            echo "<center><font color = 'green'><b>Выплачено!</b><BR /></font><b>Напишите и приложите скриншот о выплате на форуме MMGP и получите дополнительные бонусы! <font color = 'green'>подробнее...</font></b></center>";
                                             
                                        }
                                        else
                                        {
                                         
                                            echo "<center><font color = 'red'><b>Внутреняя ошибка - сообщите о ней администратору!</b></font></center>";   
                                         
                                        }
                                     
                                     
                                    }else echo "<center><font color = 'red'><b>Внутреняя ошибка - сообщите о ней администратору!</b></font></center>";
                                     
                                }else echo "<center><font color = 'red'><b>Не удалось выплатить! Попробуйте позже</b></font></center>";
                                 
                            }else echo "<center><font color = 'red'><b>Не удалось выплатить! Попробуйте позже</b></font></center>";
                             
       }else echo "<center><font color = 'red'><b>В ближайшие 24 часа Вы уже получали выплату! Попробуйте позже</b></font></center>";
           
                        }else echo "<center><font color = 'red'><b>У вас имеются необработанные заявки. Дождитесь их выполнения.</b></font></center>";
                             
                         
                    }else echo "<center><font color = 'red'><b>Вы указали больше, чем имеется на вашем счету</b></font></center>";
                 
} else echo "<center><b><font color = 'blue'>Для вашего статуса превышена запрошенная сумма!</font></b></center><BR />";
                }else echo "<center><b><font color = 'red'>Минимальная сумма для выплаты составляет {$minPay} серебра!</font></b></center>";
         
        }else echo "<center><b><font color = 'red'>Кошелек Payeer указан неверно! Смотрите образец!</font></b></center>";
      }else echo "<center><b><font color = 'red'>Платежный пароль указан не верно!</font></b></center><BR />";
         
    }
?>
  <?php
if($user_dataa['plat_pass'] == 0) {
  echo "<center><b><font color = 'red'>Укажите платежный пароль в настройках!</font></b></center><BR />";
} else {
if ($user_data["payeer_wallet"]!='0') {

?>
<?php 
if(isset($galla)) { 
?>
<form action="" method="post">
<table width="99%" border="0" align="center">
  <tr>
  
  
  
    <td><font color="#000;">Ваш кошелек Payeer  </font>: </td>
 <td><input type="text" name="purse"   value="<?=$user_data["payeer_wallet"];?>" size="15"/></td>
  </tr>
  
   <tr>

  </tr>
  
  <tr>
    <td><font color="#000;">Отдаете серебро для вывода</font> [Мин. 100</span>]<font color="#000;">:</font> </td>
 <td><input type="text" name="sum" id="sum" value="<?=round($user_data["money_p"]); ?>" size="15" onkeyup="PaymentSum();" /></td>
  </tr>
  <tr>
    <td><font color="#000;">Получаете <span id="res_val"></span></font><font color="#000;">:</font> </td>
 <td>
  <tr>
    <td><font color="#000;">Платежный пароль[указывается в профиле]</font>: </td>
  <td><input type="text" name="plat_pass" size="15"/></td>
  </tr>
 <input type="text" name="res" id="res_sum" style="text-align: center;" value="0" size="15" disabled="disabled"/>
 <input type="hidden" name="per" id="RUB" value="<?=$sonfig_site["ser_per_wmr"]; ?>" disabled="disabled"/>
 <input type="hidden" name="per" id="min_sum_RUB" value="0.5" disabled="disabled"/>
 <input type="hidden" name="val_type" id="val_type" value="RUB" />
 </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="swap" class="sumserf2" value="Заказать выплату" style="height: 3.5vw; margin-top:10px;" /></td>
  </tr>
</table>
</form>
<script language="javascript">PaymentSum(); SetVal();</script>
<?php } ?>
  <? } 
else echo "
 <div style='margin:8px; background: red; color: white; border: 2px dashed white; padding: 10px;'>
<h3>Вам необходимо добавить кошелек Payeer в настройках аккаунта! <a href='/account/config' style='color: white;' >перейти>></a> </h3>
</div>
  
 

";
}
?>

  
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h4>Последние 10 выплат</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">Серебро</td>
    <td align="center" class="m-tb">Получаете</td>
 <td align="center" class="m-tb">Кошелек</td>
 <td align="center" class="m-tb">Дата</td>
 <td align="center" class="m-tb">Статус</td>
  </tr>
  <?PHP
    
  $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 10");
    
 if($db->NumRows() > 0){
    
    while($ref = $db->FetchArray()){
    
  ?>
  <tr class="htt">
      <td align="center"><?=$ref["serebro"]; ?></td>
      <td align="center"><?=sprintf("%.2f",$ref["sum"] - $ref["comission"]); ?> <?=$ref["valuta"]; ?></td>
      <td align="center"><?=$ref["purse"]; ?></td>
   <td align="center"><?=date("d.m.Y",$ref["date_add"]); ?></td>
      <td align="center"><?=$status_array[$ref["status"]]; ?></td>
    </tr>
  <?PHP
    
  }
    
 }else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
    
  ?>
  
    
</table><div class="clr"></div>  
</div>
</div>
</div>
