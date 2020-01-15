<?PHP
######################################
# Скрипт Fruit Farm
# Автор Cris Ivy
# Telegram: @chris_ivy
######################################
$_OPTIMIZATION["title"] = "Аккаунт";
$_OPTIMIZATION["description"] = "Аккаунт пользователя";
$_OPTIMIZATION["keywords"] = "Аккаунт, личный кабинет, пользователь";

# Блокировка сессии
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		
		
		case "404": include("pages/_404.php"); break; // Страница ошибки
		case "stats": include("pages/account/_story.php"); break; // Статистика
		case "history": include("pages/account/_history.php"); break; // Статистика
		case "referals": include("pages/account/_referals.php"); break; // referals
		case "buy": include("pages/account/_buy.php"); break; // buy miner
		case "mining": include("pages/account/_mining.php"); break; // mining
		case "swap": include("pages/account/_swap.php"); break; // Обменный пункт
		case "market": include("pages/account/_market.php"); break; // Рынок
		case "change": include("pages/account/_change.php"); break; // Обмен
		case "withdraw": include("pages/account/_payment.php"); break; // Выплата WM
		case "deposit": include("pages/account/_insert.php"); break; // Пополнение баланса
		case "set": include("pages/account/_config.php"); break; // Настройки
		case "advpic": include("pages/account/_advpic.php"); break;
		case "exit": @session_destroy(); Header("Location: /"); return; break; // Выход
		case "bonusforreinv": include("pages/account/_bonusforreinv.php"); break;
		case "insertpm": include("pages/account/_insert_perfect.php"); break; // Пополнение баланса PerfectMoney
		case "perfect": include("pages/account/_perfect.php"); break; // перфект 
		case "success": include("pages/account/_success1.php"); break; // ручные пополнения 
		case "paymentpm": include("pages/account/_payment_perfect.php"); break; // Выплата PerfectMoney
		case "payment_serf": include("pages/account/_payment_serf.php"); break; // Выплата WM
		case "insertfk": include("pages/account/_insertfk.php"); break; // Пополнение баланса

		case "pesok_insert": include("pages/account/_pesok_insert.php"); break;
		// PAYKASSA
		case "insert_paykassa": include("pages/account/_insert_paykassa.php"); break;
		case "payment_paykassa": include("pages/account/_payment_paykassa.php"); break;
		case "payma": include("pages/account/_payma.php"); break; // Склад
		# серфинг

	case "chooseava": include("pages/account/_chooseava.php"); break;
	# Страница ошибки
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/account/_user_account.php");

?>