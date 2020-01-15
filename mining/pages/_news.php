<?PHP

$_OPTIMIZATION["title"] = "Новости";
$_OPTIMIZATION["description"] = "Новости проекта";
$_OPTIMIZATION["keywords"] = "Новости нашего проекта";
?>

<div class="silver-bk ">
	<div class="indexx">
		<h1>NEWS</h1>
	</div>
	<div class="container mon_row">
		

		<?PHP

$db->Query("SELECT * FROM db_news ORDER BY id DESC");

if($db->NumRows() > 0){

	while($news = $db->FetchArray()){
		?>


		<div class="articl">
			<div class="mon_col_title">
				<h2><?=$news["title"]; ?></h2>
			</div>
			<div class="flex_art">
				<div class="mon_col_txt "><?=$news["news"]; ?></div>
			</div>
			<div class="mon_col_stat">
				<div class="ristr"><i class="far fa-calendar-alt"></i> <b><?=date("d.m.Y",$news["date_add"]); ?></b></div>
			</div>
		</div>


		<?PHP

	}

}else echo "<center>Новостей нет :(</center>";
?>

	</div>
</div>

<div class="clr"></div>