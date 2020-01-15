<ul class="hd-menu">
    <li><a href="/" <?=(!isset($_GET["menu"]) OR strtolower($_GET["menu"]) == "index") ? 'class="current"' : False; ?>>Главная</a></li>

    <li><a href="/marketing" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "marketing") ? 'class="current"' : False; ?>>Маркетинг</a></li>

    <li><a href="/otziv" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "otziv") ? 'class="current"' : False; ?>>Отзывы</a></li>

    <li><a href="/about" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "about") ? 'class="current"' : False; ?>>О ферме</a></li>

    <li><a href="/rules" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "rules") ? 'class="current"' : False; ?>>Правила</a></li>

    <li><a href="/?menu=support">Контакты</a></li>





    <li><a href="/payments" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "payments") ? 'class="current"' : False; ?>>Выплаты</a></li>
    
     <li><a href="/top" <?=(isset($_GET["menu"]) AND strtolower($_GET["menu"]) == "marketing") ? 'class="current"' : False; ?>>Toп</a></li>


</ul> 