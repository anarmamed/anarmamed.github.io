<?php
session_start();
define('playCom', 0.1);
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
# РљРѕРЅСЃС‚Р°РЅС‚Р° РґР»СЏ Include
define("CONST_RUFUS", true);

# РђРІС‚РѕРїРѕРґРіСЂСѓР·РєР° РєР»Р°СЃСЃРѕРІ
function __autoload($name){ include($_SERVER['DOCUMENT_ROOT']."/classes/_class.".$name.".php");}

# РљР»Р°СЃСЃ РєРѕРЅС„РёРіР° 
$config = new config;

# Р¤СѓРЅРєС†РёРё
$func = new func;

# Р‘Р°Р·Р° РґР°РЅРЅС‹С…
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

$db->Query('SELECT `money_b` FROM `db_users_b` WHERE id = '.$usid);
$u_balance = $db->FetchRow();
$db->Query("SELECT * FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"]));

if($db->NumRows() == 0){
	echo "<script type='text/javascript'>
$('.play-".intval($_POST["id"])."').html('РРіСЂР° РЅРµ РЅР°Р№РґРµРЅР°');
</script>";
return;
}

$row = $db->FetchArray();

$err = NULL;
if($u_balance < round($row["summa"],2))
	$err .= "РќР° Р’Р°С€РµРј Р±Р°Р»Р°РЅСЃРµ РЅРµРґРѕСЃС‚Р°С‚РѕС‡РЅРѕ СЃСЂРµРґСЃС‚РІ. ";
if($_POST["item"] > 3 OR $_POST["item"] <1)
	$err .= "Р’С‹Р±РµСЂРёС‚Рµ РїСЂРµРґРјРµС‚. ";
	
if($err != NULL){
	echo "<script type='text/javascript'>
$('.play-".intval($_POST["id"])."').html('".$err."');
</script>";
	return;
}


if($row["item"] == $_POST["item"]){
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + ".$row["summa"]." WHERE `user`  = '".$row["login"]."'");			
			$db->Query("DELETE FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"]));
			
			echo "<script type='text/javascript'>$('.play-".intval($_POST["id"])."').html('РќРёС‡СЊСЏ');</script>";
			
		}elseif(($row["item"] == 1 AND $_POST["item"] == 2) OR ($row["item"] == 2 AND $_POST["item"] == 3) OR ($row["item"] == 3 AND $_POST["item"] == 1)){
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` - ".$row["summa"]." WHERE `user`  = '".$uname."'");
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + ".round(($row["summa"] + $row["summa"]*(1-playCom)) ,2)." WHERE `user`  = '".$row["login"]."'");		
			
			$db->Query("DELETE FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"]));
			echo "<script type='text/javascript'>$('.play-".intval($_POST["id"])."').html('<font color=\"#f00\">РџРѕСЂР°Р¶РµРЅРёРµ</font>');
</script>";
		}else{
						
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + ".round($row["summa"]*(1-playCom),2)." WHERE `user`  = '".$uname."'");						
			$db->Query("DELETE FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"]));
			echo "<script type='text/javascript'>$('.play-".intval($_POST["id"])."').html('<font color=\"#0F680B\">РџРѕР±РµРґР°</font>');</script>";
		}
?>