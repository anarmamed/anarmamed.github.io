<?PHP 
# Тут вставляем в куки ID referera
if(isset($_GET["i"])){
$_rid = (intval($_GET["i"]) > 0) ? intval($_GET["i"]) : 1; 
setcookie("i",$_rid,time()+2592000);
header("Location: /");
}


# ‘тавим в куку откуда пришЮл юзер (моЮ)
if (!isset($_COOKIE['rsite'])) {
$url = isset($_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER']:'';
$Refer = parse_url($url);
setcookie('rsite', $Refer['host'], time() + 24 * 3600);
}


?>