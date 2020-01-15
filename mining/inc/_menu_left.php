<?PHP

if(isset($_SESSION["user"]) OR isset($_SESSION["admin"])){

	if(isset($_SESSION["admin"]) AND isset($_GET["menu"]) AND $_GET["menu"] == "mo4cloud"){
	
		include("inc/_admin_menu.php");
	
	}elseif(isset($_SESSION["user"]) AND $_SERVER[REQUEST_URI]!="/"){ 
		
			include("inc/_user_menu.php");
		
		}
	
}

$uri = $_SERVER['REQUEST_URI'];

if(isset($_SESSION["user"]) OR isset($_SESSION["admin"])){
include("inc/_stats1.php");
} elseif ($_SERVER[REQUEST_URI]!="/") {
	include("inc/_stats1.php");
}

?>
