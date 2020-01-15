<?php

 	error_reporting(0); // вывод ошибок




if($_GET['menu']!='admin' && 'support'){
	 $ralf =  $_SERVER['REQUEST_URI'];
if (strpos($ralf, 'mo4cloud')) {
 }else{ 
function limpiarez($mensaje){
$mensaje = htmlspecialchars(trim($mensaje));
$mensaje = str_replace("'","?",$mensaje);
$mensaje = str_replace(";","¦",$mensaje);
$mensaje = str_replace("$"," USD ",$mensaje);
$mensaje = str_replace("<","?",$mensaje);
$mensaje = str_replace(">","?",$mensaje);
$mensaje = str_replace('"',"”",$mensaje);
$mensaje = str_replace("%27"," ",$mensaje);
$mensaje = str_replace("0x29"," ",$mensaje);
$mensaje = str_replace("& amp ","&",$mensaje);
return $mensaje;
}

foreach($HTTP_POST_VARS as $i => $value){$HTTP_POST_VARS[$i]=limpiarez($HTTP_POST_VARS[$i]);}
foreach($HTTP_GET_VARS as $i => $value){$HTTP_GET_VARS[$i]=limpiarez($HTTP_GET_VARS[$i]);}
foreach($_POST as $i => $value){$_POST[$i]=limpiarez($_POST[$i]);}
foreach($_GET as $i => $value){$_GET[$i]=limpiarez($_GET[$i]);}
foreach($_COOKIE as $i => $value){$_COOKIE[$i]=limpiarez($_COOKIE[$i]);}


foreach($HTTP_POST_VARS as $i => $value){$HTTP_POST_VARS[$i]=stripslashes($HTTP_POST_VARS[$i]);}
foreach($HTTP_GET_VARS as $i => $value){$HTTP_GET_VARS[$i]=stripslashes($HTTP_GET_VARS[$i]);}
foreach($_POST as $i => $value){$_POST[$i]=stripslashes($_POST[$i]);}
foreach($_GET as $i => $value){$_GET[$i]=stripslashes($_GET[$i]);}
foreach($_COOKIE as $i => $value){$_COOKIE[$i]=stripslashes($_COOKIE[$i]);}

################## Фильтрация всех POST и GET #######################################
function filter_sf(&$sf_array) 
{ 
while (list ($X,$D) = each ($sf_array)): 
$sf_array[$X] = limpiarez(mysql_escape_string(strip_tags(htmlspecialchars($D))));
endwhile;
}
function filtersss($arrews) 
{ 
$arrews = mb_ereg_replace('&amp;amp¦amp¦lt¦', '<', $arrews);
$arrews = mb_ereg_replace('&amp;amp¦amp¦gt¦', '>', $arrews);
$arrews = mb_ereg_replace('&amp;amp¦amp¦amp¦amp¦amp¦quot¦', '"', $arrews);
$arrews = mb_ereg_replace('amp¦amp¦amp¦', '', $arrews);
$arrews = mb_ereg_replace('&amp;amp¦amp¦quot¦', '"', $arrews);
return $arrews;
}
filter_sf($_GET);
filter_sf($_POST); 
#####################################################################################

function anti_sql() 
{
$check = html_entity_decode( urldecode( $_SERVER['REQUEST_URI'] ) );
$check = str_replace( "", "/", $check );

$check = mysql_real_escape_string($str);
$check = trim($str); 
$check = array("AND","UNION","SELECT","WHERE","INSERT","UPDATE","DELETE","OUTFILE","FROM","OR","SHUTDOWN","CHANGE","MODIFY","RENAME","RELOAD","ALTER","GRANT","DROP","CONCAT","cmd","exec");
$check = str_replace($check,"",$str);


if( $check ) 
{
if((strpos($check, '<')!==false) || (strpos($check, '>')!==false) || (strpos($check, '"')!==false) || (strpos($check,"'")!==false) || (strpos($check, '*')!==false) || (strpos($check, '(')!==false) || (strpos($check, ')')!==false) || (strpos($check, ' ')!==false) || (strpos($check, ' ')!==false) || (strpos($check, ' ')!==false) ) 
{
$prover = true;
}

if((strpos($check, 'src')!==false) || (strpos($check, 'img')!==false) || (strpos($check, 'OR')!==false) || (strpos($check, 'Image')!==false) || (strpos($check, 'script')!==false) || (strpos($check, 'jаvascript')!==false) || (strpos($check, 'language')!==false) || (strpos($check, 'document')!==false) || (strpos($check, 'cookie')!==false) || (strpos($check, 'gif')!==false) || (strpos($check, 'png')!==false) || (strpos($check, 'jpg')!==false) || (strpos($check, 'js')!==false) ) 
{
$prover = true;
}

}

if (isset($prover))
{
die( "Попытка атаки на сайт или введены запрещённые символы!" );
return false;
exit;
}
}
anti_sql();

}
 }


    				


# Счетчик
function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}

$_timer_a = TimerSet();
#откуда пришел
if (!isset($_COOKIE['rsite'])) {
setcookie('rsite', $_SERVER['HTTP_REFERER'], time() + 24 * 3600);
}
# Старт сессии
@session_start();
function check_text($text) {
	  $arraysql = array('UNION','SELECT','OUTFILE','LOAD_FILE','GROUP BY','ORDER BY','INFORMATION_SCHEMA.TABLES','BENCHMARK','FLOOR'/*,'SLEEP'*/,'CHAR');
	  $replacesql ='';
	  $text2=$text;
	  $text2=mb_strtoupper($text2);
	  $text2=str_replace($arraysql, $replacesql, $text2,$count);
	  if($count!=0){ echo "Ошибка, сработала защита.<br>Подозрение на SQL inj или XXS "; exit;}
	  
	  $array_find = array("'",'"','/**/','0x','/*','--');
	  $array_replace ='';
	  $text=str_replace($array_find, $array_replace, $text);
	return $text;
}
foreach($_GET as $i => $value){ $_GET[$i]=check_text($_GET[$i]);}
foreach($_POST as $i => $value){ $_POST[$i]=check_text($_POST[$i]);}
foreach($_COOKIE as $i => $value){ $_COOKIE[$i]=check_text($_COOKIE[$i]);}
 
# Старт буфера
@ob_start();

# Default
$_OPTIMIZATION = array();
$_OPTIMIZATION["title"] = "Evolution-Mining";
$_OPTIMIZATION["description"] = "Evolution-Mining ";
$_OPTIMIZATION["keywords"] = "Заработок на растениях, вложения, заработать, ферма, денежная ферма, заработать на ферме, mining, economic, game, экономическая, игра";

# Константа для Include
define("CONST_RUFUS", true);

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига 
$config = new config;

# Функции
$func = new func;

# Установка REFERER
include("inc/_set_referer.php");

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

/*#данные для срока 
$life_time = new life_time($db);
$life_time->CheckTime();*/
 
# Шапка
@include("inc/_header.php");

		if(isset($_GET["menu"])){
		
			$menu = strval($_GET["menu"]);
			
			switch($menu){
			
				case "404": include("pages/_404.php"); break; // Страница ошибки
				case "rules": include("pages/_rules.php"); break; // RULES
				case "faq": include("pages/_faq.php"); break; // FAQ
				case "about": include("pages/_about.php"); break; // О проекте
				case "contacts": include("pages/_contacts.php"); break; // Контакты
				case "news": include("pages/_news.php"); break; // Новости
				case "signup": include("pages/_signup.php"); break; // Регистрация
				case "recovery": include("pages/_recovery.php"); break; // Восстановление пароля
				case "account": include("pages/_account.php"); break; // Аккаунт
				case "payments": include("pages/_payments_list.php"); break; // Выплаты
				case "competition": include("pages/_competition.php"); break; // Конкурсы
				case "minclo4d": include("pages/_admin.php"); break; // Админка
				case "top": include("pages/_top.php"); break; // Топ
				case "cronaseraz": include("pages/_cronaseraz.php"); break; // Cron 
				case "bounty": include("pages/_bounty.php"); break; // Bounty
				case "mo4cloud": include("pages/_admin.php"); break;
			# Страница ошибки
			default: @include("pages/_404.php"); break;
			
			}
			
		}else @include("pages/_index.php");


# Подвал
@include("inc/_footer.php");


# Заносим контент в переменную
$content = ob_get_contents();

# Очищаем буфер
ob_end_clean();
	
	# Заменяем данные
	$content = str_replace("{!TITLE!}",$_OPTIMIZATION["title"],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION["description"],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION["keywords"],$content);
	$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", (TimerSet() - $_timer_a)) ,$content);
	
	# Вывод баланса
	if(isset($_SESSION["user_id"])){
	
		$user_id = $_SESSION["user_id"];
		$db->Query("SELECT money_b, money_p,money_serf FROM db_users_b WHERE id = '$user_id'");
		$balance = $db->FetchArray();
		
		$content = str_replace('{!BALANCE_B!}', sprintf("%.2f", $balance["money_b"]) ,$content);
		$content = str_replace('{!BALANCE_P!}', sprintf("%.2f", $balance["money_p"]) ,$content);
		
$content = str_replace('{!BALANCE_SERF!}', sprintf("%.2f", $balance["money_serf"]) ,$content);
	}
	
// Выводим контент
echo $content;
?>
