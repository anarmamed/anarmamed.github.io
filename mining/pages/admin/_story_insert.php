<style>
	td {
    font-size:1.7vw !important;
    }
   
</style>
<div class="silver-bk justify-content-center">
  <div class="row justify-content-center">
    <div class="col-8 justify-content-center">
      <div class="indexx">
        <span>История пополнений</span>
      </div>
    </div>
    <div class="col-11 justify-content-center inde"> 
<center><a href="/?menu=shar4terra&sel=story_insert">Список пополнений</a> || <a href="/?menu=shar4terra&sel=story_insert&list_day">По дням</a> || <a href="/?menu=shar4terra&sel=story_insert&last_31">График за 30 дней</a> || <a href="/?menu=shar4terra&sel=story_insert&all_time">Полностью все</a></center><BR />
<?PHP
# График
if(isset($_GET["last_31"])){
	
	$dlim = time() - 60*60*24*30;
	$db->Query("SELECT * FROM db_insert_money WHERE date_add > $dlim AND status = '0' ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# Вывод
	if(count($days_money) > 0){
		
		$array_for_chart = array();
		$array_for_chart2 = array();
		$array_for_chart3 = array();
		
			foreach($days_money as $date => $sum){
			
				$array_for_chart[] = "['".$date."', ".round($sum)."]";
				$array_for_chart2[] = "['".$date."', ".$days_insert[$date]."]";
				$array_for_chart3[] = "['".$date."', ".round($sum / $days_insert[$date], 2)."]";
			
			}
			
			$retd = implode(", ", array_reverse($array_for_chart));
			$retd2 = implode(", ", array_reverse($array_for_chart2));
			$retd3 = implode(", ", array_reverse($array_for_chart3));
			
		?>

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd; ?>
        ]);

        var options = {
          title: 'История пополнений (Сумма)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div id="chart_div" style="width: 100%; height: 500px;"></div>
	
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['День', 'Кол-во'],
          <?=$retd2; ?>
        ]);

        var options2 = {
          title: 'История пополнений (Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
	<div id="chart_div2" style="width: 100%; height: 500px;"></div>
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data3 = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd3; ?>
        ]);

        var options3 = {
          title: 'На какую сумму в среднем пополняют игроки (Сумма / Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };

        var chart3 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }
    </script>
	<div id="chart_div3" style="width: 100%; height: 500px;"></div>
	
	
		<?PHP
		
	}
	
	}else echo "<center><b>Записей нет</b></center><BR />";
	
	
	
?></div></div></div></div><div class="clr"></div>	<?PHP
return;
}


# Вывод статистики по дням
if(isset($_GET["list_day"])){

	$db->Query("SELECT * FROM db_insert_money WHERE status = '0' ORDER BY id DESC");
	
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# Вывод
	if(count($days_money) > 0){
	
		?>
		<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
		  <tr bgcolor="#efefef">
			<td align="center" class="m-tb">Дата</td>
			<td align="center" class="m-tb">Пополнений</td>
			<td align="center" class="m-tb">На сумму</td>
			<td align="center" class="m-tb">В среднем:</td>
		  </tr>
		<?PHP
		
		$array_for_chart = array();
		
			foreach($days_money as $date => $sum){
			
				?>
				<tr class="htt">
					<td align="center"><b><?=$date; ?></b></td>
					<td align="center"><?=$days_insert[$date]; ?> шт.</td>
					<td align="center"><?=$sum; ?> <?=$config->VAL;?></td>
					<td align="center"><?=round($sum/$days_insert[$date],2); ?> <?=$config->VAL;?></td>
				</tr>
				<?PHP
				
			}
			
		?>
		</table>
		<?PHP
		
	}
	
	}else echo "<center><b>Записей нет</b></center><BR />";
	
	
	
?></div></div></div></div><div class="clr"></div>	<?PHP
return;
}

if(isset($_GET["all_time"])){ 


	$db->Query("SELECT * FROM db_insert_money  INNER JOIN db_users_a ON db_insert_money.user_id = db_users_a.id WHERE db_insert_money.status = '0' ORDER BY db_insert_money.id DESC");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb">ID</td>
    <td align="center" class="m-tb">Пользователь</td>
    <td align="center" class="m-tb">Лидер</td>
    <td align="center" class="m-tb">Кошелек</td>
	<td align="center" class="m-tb"><?=$config->VAL; ?></td>
	<td align="center" class="m-tb">Дата операции</td>
  </tr>
<?PHP
	while($data = $db->FetchArray()){
	?>
	<tr class="htt">
    <td align="center" ><?=$data["id"]; ?></td>
    <td align="center" ><?=$data["user"]; ?></td>
    <td align="center" ><?=$data["referer"]; ?></td>
   
    <td align="center" ><?=$data["plat"]; ?></td>
	<td align="center" ><?=$data["money"]; ?></td>
	<td align="center" ><?=date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	}
?>
</table>
<?PHP

}else echo "<center><b>Записей нет</b></center><BR />";
?>
</div></div></div></div>
<div class="clr"></div>
<?php
return;
}

/*$tdadd = time() - 5*60;
	if(isset($_POST["clean"])){
	
		$db->Query("DELETE FROM db_insert_money WHERE date_add < '$tdadd' AND status = '0' ");
		echo "<center><font color = 'green'><b>Очищено</b></font></center><BR />";
	}*/
	$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
	$lim = $num_p * 200;

$db->Query("SELECT * FROM db_insert_money  INNER JOIN db_users_a ON db_insert_money.user_id = db_users_a.id WHERE db_insert_money.status = '0' ORDER BY db_insert_money.id DESC LIMIT {$lim}, 200");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb">ID</td>
    <td align="center" class="m-tb">Пользователь</td>
    <td align="center" class="m-tb">Лидер</td>
    
    <td align="center" class="m-tb">Кошелек</td>
	<td align="center" class="m-tb"><?=$config->VAL; ?></td>
	<td align="center" class="m-tb">Дата операции</td>
  </tr>


<?PHP
function colorSum($sum, $val){

	if($sum >= 500) return "red";
	if($val == "PerfectMoney") return "blue";
	return "#000000";
}
	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
    <td align="center" ><?=$data["id"]; ?></td>
    <td align="center" ><?=$data["user"]; ?></td>
    <td align="center" ><?=$data["referer"]; ?></td>
   
    <td align="center" ><?=$data["plat"]; ?></td>
	<td align="center" ><b><font color="<?=colorSum($data["money"],$data["plat"]); ?>"><?=$data["money"]; ?></font></b></td>
	<td align="center" ><?=date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<!-- <BR />
<form action="" method="post">
<center><input type="submit" name="clean" value="Очистить" /></center>
</form> -->

<?PHP

$db->Query("SELECT COUNT(*) FROM db_insert_money WHERE status = '0'");
$all_pages = $db->FetchRow();
	if($all_pages > 200){	
	$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;	
	$nav = new navigator;
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;	
	echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 200), "/?menu=shar4terra&sel=story_insert&page="), "</center>";
	}

}else echo "<center><b>Записей нет</b></center><BR />";
?>

</div>
</div>
</div>
</div>
<div class="clr"></div>	