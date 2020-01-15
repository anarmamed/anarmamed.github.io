<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Административная панель";
$_OPTIMIZATION["description"] = "Аккаунт пользователя";
$_OPTIMIZATION["keywords"] = "Аккаунт, личный кабинет, пользователь";
$not_counters = true;
# Блокировка сессии
if(!isset($_SESSION["admin"])){ include("pages/admin/_login.php"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		case "cran_a": include("pages/admin/_cran_a.php"); break; // Настройки Крана и статистика
		case "compconfig": include("pages/admin/_compconfig.php"); break; // Управление конкурсами
		case "compconfiginv": include("pages/admin/_comp_inv_config.php"); break; // Управление конкурсами инвесторов
		case "404": include("pages/_404.php"); break; // Страница ошибки
		case "stats": include("pages/admin/_stats.php"); break; // Статистика
		case "statart": include("pages/admin/_statart.php"); break; // Статистика
		case "config": include("pages/admin/_config.php"); break; // Настройки
		case "contacts": include("pages/admin/_contacts.php"); break; // Контакты
		case "rules": include("pages/admin/_rules.php"); break; // Правила
		case "video": include("pages/admin/_video.php"); break; // ВИДЕО
		case "auction": include("pages/admin/_auction.php"); break; // Аукцион
		case "reklamstats": include("pages/admin/_reklamstats.php"); break; // откуда пришел реф
		case "about": include("pages/admin/_about.php"); break; // о ферме
		case "story_buy": include("pages/admin/_story_buy.php"); break; // История покупок деревьев
		case "story_swap": include("pages/admin/_story_swap.php"); break; // История обмена в обменнике
		case "story_insert": include("pages/admin/_story_insert.php"); break; // История пополнений баланса
		case "story_sell": include("pages/admin/_story_sell.php"); break; // История рынка
		case "news": include("pages/admin/_news_a.php"); break; // Новости
		case "monitor": include("pages/admin/_monitor_a.php"); break; // Мониторинг
		case "users": include("pages/admin/_users.php"); break; // Список пользователей
		case "sender": include("pages/admin/_sender.php"); break; // Рассылка пользователям	
		case "pay_systems": include("pages/admin/_pay_systems.php"); break;
		case "payments": include("pages/admin/_payments.php"); break; // Запросы на выплаты WM
		case "inse": include("pages/admin/_inse.php"); break; // Запросы на пополнения
		case "protect": include("pages/admin/_protect.php"); break; // Защита от хакеров Перфект Мани
		case "payments2": include("pages/admin/_payments2.php"); break; // Запросы на выплаты WM
		case "cheap_fruit": include("pages/admin/_cheap_fruit.php"); break; // Дешевые фрукты
		case "multi": include("pages/admin/_multi.php"); break;
		case "multihide": include("pages/admin/_multihide.php"); break;
		case "jobs": include("pages/admin/_jobs.php"); break; // Задания - проверка
		case "jobs_no": include("pages/admin/_jobs_no.php"); break; // Задания - отмененные
		case "jobswr": include("pages/admin/_jobswr.php"); break; // Задания - админ создает задание
		case "serf": include("pages/admin/_serf.php"); break;
		case "refleader": include("pages/admin/_refleader.php"); break;
		case "five": include("pages/admin/_five.php"); break;
		case "bubbles": include("pages/admin/_bubbles.php"); break;
		case "bank_setting": include("pages/admin/_bank_setting.php"); break; // Банк 
		case "pond": include("pages/admin/_pond.php"); break; // Пруд 
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/admin/_stats.php");

?>