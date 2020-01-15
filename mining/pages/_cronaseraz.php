<?PHP
$_OPTIMIZATION["title"] = "Cron";
$time = time();
  # Устанавливаем автоматическое обновление курса криптовалют
  $db->Query("SELECT * FROM db_crypt WHERE id = '1' LIMIT 1");
  $sys_namm = $db->FetchArray();
  if ($sys_namm["new_time"]<= time() - 60*1) {
    $json_string = 'http://api.cryptonator.com/public/v1/ticker/BTC-USD_ETH-USD_LTC-USD_DOGE-USD_DASH-USD_BCH-USD_ZEC-USD_XMR-USD_ETC-USD_XRP-USD_NEO-USD_ADA-USD';
$jsondata = file_get_contents($json_string);
$obj = json_decode($jsondata,true);
$new_time = $obj["timestamp"];
if ($obj["tickers"][0]["price"] !=0) {
  $new_BTC = $obj["tickers"][0]["price"];
  $new_BTCc = $obj["tickers"][0]["change"];
}else{$new_BTC=$sys_namm["BTC"];$new_BTCc=$sys_namm["BTCc"];}

if ($obj["tickers"][1]["price"] !=0) {
  $new_ETH = $obj["tickers"][1]["price"];
  $new_ETHc = $obj["tickers"][1]["change"];
}else{$new_ETH=$sys_namm["ETH"];$new_ETHc=$sys_namm["ETHc"];}

if ($obj["tickers"][2]["price"] !=0) {
  $new_LTC = $obj["tickers"][2]["price"];
  $new_LTCc = $obj["tickers"][2]["change"];
}else{$new_LTC=$sys_namm["LTC"];$new_LTCc=$sys_namm["LTCc"];}

if ($obj["tickers"][3]["price"] !=0) {
  $new_DOGE = $obj["tickers"][3]["price"];
  $new_DOGEc = $obj["tickers"][3]["change"];
}else{$new_DOGE=$sys_namm["DOGE"];$new_DOGEc=$sys_namm["DOGEc"];}

if ($obj["tickers"][4]["price"] !=0) {
  $new_DASH = $obj["tickers"][4]["price"];
  $new_DASHc = $obj["tickers"][4]["change"];
}else{$new_DASH=$sys_namm["DASH"];$new_DASHc=$sys_namm["DASHc"];}

if ($obj["tickers"][5]["price"] !=0) {
  $new_BCH = $obj["tickers"][5]["price"];
  $new_BCHc = $obj["tickers"][5]["change"];
}else{$new_BCH=$sys_namm["BCH"];$new_BCHc=$sys_namm["BCHc"];}

if ($obj["tickers"][6]["price"] !=0) {
  $new_ZEC = $obj["tickers"][6]["price"];
  $new_ZECc = $obj["tickers"][6]["change"];
}else{$new_ZEC=$sys_namm["ZEC"];$new_ZECc=$sys_namm["ZECc"];}

if ($obj["tickers"][7]["price"] !=0) {
  $new_XMR = $obj["tickers"][7]["price"];
  $new_XMRc = $obj["tickers"][7]["change"];
}else{$new_XMR=$sys_namm["XMR"];$new_XMRc=$sys_namm["XMRc"];}

if ($obj["tickers"][8]["price"] !=0) {
  $new_ETC = $obj["tickers"][8]["price"];
  $new_ETCc = $obj["tickers"][8]["change"];
}else{$new_ETC=$sys_namm["ETC"];$new_ETCc=$sys_namm["ETCc"];}

if ($obj["tickers"][9]["price"] !=0) {
  $new_XRP = $obj["tickers"][9]["price"];
  $new_XRPc = $obj["tickers"][9]["change"];
}else{$new_XRP=$sys_namm["XRP"];$new_XRPc=$sys_namm["XRPc"];}

if ($obj["tickers"][10]["price"] !=0) {
  $new_NEO = $obj["tickers"][10]["price"];
  $new_NEOc = $obj["tickers"][10]["change"];
}else{$new_NEO=$sys_namm["NEO"];$new_NEOc=$sys_namm["NEOc"];}

if ($obj["tickers"][11]["price"] !=0) {
  $new_ADA = $obj["tickers"][11]["price"];
  $new_ADAc = $obj["tickers"][11]["change"];
}else{$new_ADA=$sys_namm["ADA"];$new_ADAc=$sys_namm["ADAc"];}
/* Проверка на загрузку курса в переменные
echo $new_BTC.'<br/>'.$new_ETH.'<br/>'.$new_LTC.'<br/>'.$new_DOGE.'<br/>'.$new_DASH.'<br/>'.$new_BCH.'<br/>'.$new_ZEC.'<br/>'.$new_XMR.'<br/>'.$new_ETC.'<br/>'.$new_XRP;*/
$db->Query("UPDATE db_crypt SET BTC = '$new_BTC', BTCc = '$new_BTCc', ETH = '$new_ETH', ETHc = '$new_ETHc', LTC = '$new_LTC', LTCc = '$new_LTCc', DOGE = '$new_DOGE', DOGEc = '$new_DOGEc', DASH = '$new_DASH', DASHc = '$new_DASHc', BCH = '$new_BCH', BCHc = '$new_BCHc', ZEC = '$new_ZEC', ZECc = '$new_ZECc', XMR = '$new_XMR', XMRc = '$new_XMRc', ETC = '$new_ETC', ETCc = '$new_ETCc', XRP = '$new_XRP', XRPc = '$new_XRPc', NEO = '$new_NEO', NEOc = '$new_NEOc', ADA = '$new_ADA', ADAc = '$new_ADAc', new_time = '$new_time' WHERE id = '1' ");
echo "Произошло обновление курсов. Каждые 5 минут. Техническая информация:";
/*echo $new_BTC;*/
echo "<pre>";
print_r($obj);
echo "</pre>";
  }
  ?>

</div>
<div class="clr"></div>