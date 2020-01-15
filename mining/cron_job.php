<?PHP

@error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);

# Константа для Include
define('CONST_RUFUS', true);

# Автоподгрузка классов
function __autoload($name){ include('classes/_class.'.$name.'.php');}

# Класс конфига 
$config = new config;

$type = 'sender';

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

switch($type){
	case 'sender': include('cron_job/_sender.php'); break; // Отправка пользователям
	default: die('Type not exist'); break;
}

?>