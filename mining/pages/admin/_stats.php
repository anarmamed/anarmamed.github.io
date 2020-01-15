<div class="silver-bk justify-content-center">
  <div class="row justify-content-center">
    <div class="col-11 justify-content-center">
      <div class="indexx">
        <span>Статистика проекта1</span>
      </div>
    </div>
    <div class="col-12 justify-content-center inde"> 
<!--       <?

# Модуль проверки баланса Payeer
@include("../classes/_class.config.php");
@include("../classes/_class.rfs_payeer.php");
$config = new config;
if(isset($_GET["var"])) var_dump($config);
$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
if ($payeer->isAuth())
{
$arBalance = $payeer->getBalance();
$balancer = $arBalance["balance"]["RUB"]["DOSTUPNO"];
$balanceb = $arBalance["balance"]["BTC"]["DOSTUPNO"];
$balancee = $arBalance["balance"]["EUR"]["DOSTUPNO"];
$balanceu = $arBalance["balance"]["USD"]["DOSTUPNO"];

}else echo "not_settings";
?> -->


<?PHP
$timeonline=time()-300;
  $db->Query("SELECT COUNT(*) FROM db_statday WHERE name !='Гость' AND time >$timeonline");
  $nlnusr = $db->FetchRow();
$db->Query("SELECT COUNT(*) FROM db_statday WHERE name ='Гость' AND time >$timeonline");
  $gost = $db->FetchRow();
  $conf_merchantPmId = $config->PmId;
  $conf_wallPm = $config->AccountPaymentPM;
$conf_merchantPmPass = $config->PmPass;
$ar = $func->PmBalance($conf_merchantPmId, $conf_merchantPmPass);
$bal_perf = $ar[$conf_wallPm];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

 $conf_merchantPmId = $config->PmId;
  $conf_wallPm = $config->AccountPaymentPM;
$conf_merchantPmPass = $config->PmPass;
$ar = $func->PmBalance($conf_merchantPmId, $conf_merchantPmPass);
$bal_perf = $ar[$conf_wallPm];

$db->Query("SELECT 
	COUNT(id) all_users, 
	SUM(money_b) money_b, 
	SUM(money_p) money_p, 
	
	SUM(a_t) a_t, 
	SUM(b_t) b_t, 
	SUM(c_t) c_t,
	
	SUM(a_b) a_b, 
	SUM(b_b) b_b, 
	SUM(c_b) c_b,
	
	SUM(all_time_a) all_time_a, 
	SUM(all_time_b) all_time_b, 
	SUM(all_time_c) all_time_c,
	
	SUM(payment_sum) payment_sum,
	SUM(insert_sum) insert_sum
	
	
	FROM db_users_b");
$data_stats = $db->FetchArray();

?>

<table  border="0" align="center">
 
  <tr class="htt">
    <td><b>На Кошельке для выплат Perfect Money осталось:</b></td>
  <td  align="center"><?=$bal_perf?> $.</td>
  </tr>
  <!-- <tr class="htt">
    <td><b>На Кошельке для выплат Payeer осталось:</b></td>
  <td  align="center"><?=$balancer?> руб. и <?=$balanceu?> $.</td>
  </tr> -->
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  <tr class="htt">
    <td><b>Зарегистрировано пользователей:</b></td>
	<td  align="center"><?=$data_stats["all_users"]?> чел.</td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  
  <tr class="htt">
    <td><b>$ на счетах (Для покупок):</b></td>
	<td  align="center"><?=sprintf("%.0f",$data_stats["money_b"]); ?></td>
  </tr>
  
  <tr class="htt">
    <td><b>$ на счетах (На вывод):</b></td>
	<td  align="center"><?=sprintf("%.0f",$data_stats["money_p"]); ?></td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  

</table>
 <br>
 
</div>
</div>
</div> <br><br>

                <div class="clr"></div>
</div>
<div class="clr"></div>	