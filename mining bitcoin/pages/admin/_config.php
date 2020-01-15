<div class="silver-bk justify-content-center">
  <div class="row justify-content-center">
    <div class="col-8 justify-content-center">
      <div class="indexx">
        <span>Настройки</span>
      </div>
    </div>
    <div class="col-11 justify-content-center inde"> 	
<?PHP
$db->Query("SELECT * FROM db_config WHERE id = '1'");
$data_c = $db->FetchArray();

# Обновление
if(isset($_POST["admin"])){

	$admin = $func->IsLogin($_POST["admin"]);
	$pass = $func->IsLogin($_POST["pass"]);
	
	$add_people = intval($_POST["add_people"]);
	$add_payout = intval($_POST["add_payout"]);
	$add_insert = intval($_POST["add_insert"]);

	$ser_per_wmr = intval($_POST["ser_per_wmr"]);
	$ser_per_wmz = intval($_POST["ser_per_wmz"]);
	$ser_per_wme = intval($_POST["ser_per_wme"]);
	$percent_swap = intval($_POST["percent_swap"]);
	$percent_sell = intval($_POST["percent_sell"]);
	$items_per_coin = intval($_POST["items_per_coin"]);
	
	$tomat_in_h = intval($_POST["a_in_h"]);
	$straw_in_h = intval($_POST["b_in_h"]);
	$pump_in_h = intval($_POST["c_in_h"]);
	$peas_in_h = intval($_POST["d_in_h"]);
	$pean_in_h = intval($_POST["e_in_h"]);

	$svintus_in_h = intval($_POST["f_in_h"]);
	# Новые персонажи сколько в час
	$person1_in_h = intval($_POST["g_in_h"]);
	$person2_in_h = intval($_POST["h_in_h"]);
	$person3_in_h = intval($_POST["i_in_h"]);
	$person4_in_h = intval($_POST["j_in_h"]);
	$person5_in_h = intval($_POST["k_in_h"]);
	# Акционные сколько в час
	$bonus2_in_h = intval($_POST["l_in_h"]);
	$bonus3_in_h = intval($_POST["m_in_h"]);
	$bonus4_in_h = intval($_POST["n_in_h"]);
	$bonus5_in_h = intval($_POST["o_in_h"]);
	$bonus6_in_h = intval($_POST["p_in_h"]);
	$bonus7_in_h = intval($_POST["r_in_h"]);
	$bonus8_in_h = intval($_POST["s_in_h"]);
	$bonus9_in_h = intval($_POST["t_in_h"]);

	$bonus10_in_h = intval($_POST["u_in_h"]);
	$bonus11_in_h = intval($_POST["v_in_h"]);
	$bonus12_in_h = intval($_POST["w_in_h"]);
	$bonus13_in_h = intval($_POST["x_in_h"]);
	# переменные для стоимости новых персонажей
	$amount_person1_t = intval($_POST["amount_g_t"]);
	$amount_person2_t = intval($_POST["amount_h_t"]);
	$amount_person3_t = intval($_POST["amount_i_t"]);
	$amount_person4_t = intval($_POST["amount_j_t"]);
	$amount_person5_t = intval($_POST["amount_k_t"]);

	$amount_bonus2_t = intval($_POST["amount_l_t"]);
	$amount_bonus3_t = intval($_POST["amount_m_t"]);
	$amount_bonus4_t = intval($_POST["amount_n_t"]);

	$amount_bonus5_t = intval($_POST["amount_o_t"]);
	$amount_bonus6_t = intval($_POST["amount_p_t"]);
	$amount_bonus7_t = intval($_POST["amount_r_t"]);
	$amount_bonus8_t = intval($_POST["amount_s_t"]);
	$amount_bonus9_t = intval($_POST["amount_t_t"]);

	$amount_bonus10_t = intval($_POST["amount_u_t"]);
	$amount_bonus11_t = intval($_POST["amount_v_t"]);
	$amount_bonus12_t = intval($_POST["amount_w_t"]);
	$amount_bonus13_t = intval($_POST["amount_x_t"]);
	
	$amount_tomat_t = intval($_POST["amount_a_t"]);
	$amount_straw_t = intval($_POST["amount_b_t"]);
	$amount_pump_t = intval($_POST["amount_c_t"]);
	$amount_peas_t = intval($_POST["amount_d_t"]);
	$amount_pean_t = intval($_POST["amount_e_t"]);

	$amount_svintus_t = intval($_POST["amount_f_t"]);
	
	# Лимиты на покупку персонажей
	$limit_tomat_t = intval($_POST["limit_a_t"]);
	$limit_straw_t = intval($_POST["limit_b_t"]);
	$limit_pump_t = intval($_POST["limit_c_t"]);
	$limit_peas_t = intval($_POST["limit_d_t"]);
	$limit_pean_t = intval($_POST["limit_e_t"]);
	$limit_svintus_t = intval($_POST["limit_f_t"]);
	
	# Если больше 5 персонажей:
	$limit_person1_t = intval($_POST["limit_g_t"]);
	$limit_person2_t = intval($_POST["limit_h_t"]);
	$limit_person3_t = intval($_POST["limit_i_t"]);
	$limit_person4_t = intval($_POST["limit_j_t"]);
	$limit_person5_t = intval($_POST["limit_k_t"]);

	$limit_bonus2_t = intval($_POST["limit_l_t"]);
	$limit_bonus3_t = intval($_POST["limit_m_t"]);
	$limit_bonus4_t = intval($_POST["limit_n_t"]);

	$limit_bonus5_t = intval($_POST["limit_o_t"]);
	$limit_bonus6_t = intval($_POST["limit_p_t"]);
	$limit_bonus7_t = intval($_POST["limit_r_t"]);
	$limit_bonus8_t = intval($_POST["limit_s_t"]);
	$limit_bonus9_t = intval($_POST["limit_t_t"]);

	$limit_bonus10_t = intval($_POST["limit_u_t"]);
	$limit_bonus11_t = intval($_POST["limit_v_t"]);
	$limit_bonus12_t = intval($_POST["limit_w_t"]);
	$limit_bonus13_t = intval($_POST["limit_x_t"]);

	# +Бонус в % на все платежки
	$bonus_in = intval($_POST["bonus_in"]);


	$payment_payeer = intval($_POST["payment_payeer"]);

	#Будильник на телеграмм для кошельков
	$payeer_alarm = intval($_POST["payeer_alarm"]);
	$payeer_usd_alarm = intval($_POST["payeer_usd_alarm"]);
	$perfect_alarm = intval($_POST["perfect_alarm"]);
	
	# Проверка на ошибки
	$errors = true;
	
	if($admin === false){
		$errors = false; echo "<center><font color = 'red'><b>Логин администратора имеет неверный формат</b></font></center><BR />"; 
	}
	
	if($pass === false){
		$errors = false; echo "<center><font color = 'red'><b>Пароль администратора имеет неверный формат</b></font></center><BR />"; 
	}
	
	if($percent_swap < 1 OR $percent_swap > 99){
		$errors = false; echo "<center><font color = 'red'><b>Прибавляемый процент при обмене должен быть от 1 до 99</b></font></center><BR />"; 
	}
	
	if($percent_sell < 1 OR $percent_sell > 99){
		$errors = false; echo "<center><font color = 'red'><b>% серебра на вывод при продаже должен быть от 1 до 99</b></font></center><BR />"; 
	}
	
	if($items_per_coin < 1 OR $items_per_coin > 50000){
		$errors = false; echo "<center><font color = 'red'><b>Сколько рыбы = 1 серебра, должно быть от 1 до 50000</b></font></center><BR />"; 
	}
	
	if($tomat_in_h < 6 OR $straw_in_h < 6 OR $pump_in_h < 6){
		$errors = false; echo "<center><font color = 'red'><b>Неверная настройка улова рыбаков в час! Минимум 6</b></font></center><BR />"; 
	}
	
	
	if($amount_tomat_t < 1 OR $amount_straw_t < 1 OR $amount_pump_t < 1){
		$errors = false; echo "<center><font color = 'red'><b>Минимальная стоимость рыбака не должна быть менее 1го серебра</b></font></center><BR />"; 
	}
	
	# Обновление
	if($errors){
	
		$db->Query("UPDATE db_config SET 
		add_people = '$add_people',
		add_insert = '$add_insert',
		add_payout = '$add_payout',
		admin = '$admin',
		pass = '$pass',
		ser_per_wmr = '$ser_per_wmr',
		ser_per_wmz = '$ser_per_wmz',
		ser_per_wme = '$ser_per_wme',
		percent_swap = '$percent_swap',
		percent_sell = '$percent_sell',
		items_per_coin = '$items_per_coin',
		a_in_h = '$tomat_in_h',
		b_in_h = '$straw_in_h',
		c_in_h = '$pump_in_h',
		amount_a_t = '$amount_tomat_t',
		amount_b_t = '$amount_straw_t',
		amount_c_t = '$amount_pump_t',
		limit_a_t = '$limit_tomat_t',
		limit_b_t = '$limit_straw_t',
		limit_c_t = '$limit_pump_t',
		bonus_in = '$bonus_in',
		payment_payeer = '$payment_payeer',
		payeer_alarm = '$payeer_alarm',
		payeer_usd_alarm = '$payeer_usd_alarm',
		perfect_alarm = '$perfect_alarm'
		WHERE id = '1'");
		
		echo "<center><font color = 'green'><b>Сохранено</b></font></center><BR />";
		$db->Query("SELECT * FROM db_config WHERE id = '1'");
		$data_c = $db->FetchArray();
	}
	
}

?>
<form action="" method="post">
<table width="100%" border="0">


	<tr>
    <td><b>Дополнительный бонус при пополнении на все кошельки:</b></td>
  </tr>
  <tr>
  	<tr>
    <td>Укажите размер бонуса при пополнении[в %]:</td>
	<td width="150" align="center"><input type="text" name="bonus_in" value="<?=$data_c["bonus_in"]; ?>"/></td>
	</tr>
	<tr>
    <td><b>________________________</b></td>
	</tr>
	
  <tr>
    <td><b>Накрутка статистики:</b></td>
  </tr>
  <tr>
  	<tr>
    <td><b>Накрутка игроков:</b></td>
	<td width="150" align="center"><input type="text" name="add_people" value="<?=$data_c["add_people"]; ?>"/></td>
	</tr>
	<tr>
    <td><b>Накрутка Выплат (в $.):</b></td>
	<td width="150" align="center"><input type="text" name="add_payout" value="<?=$data_c["add_payout"]; ?>"/></td>
	</tr>
	<tr>
    <td><b>Накрутка Пополнений (в руб.):</b></td>
	<td width="150" align="center"><input type="text" name="add_insert" value="<?=$data_c["add_insert"]; ?>"/></td>
	</tr>
  <tr>
    <td><b>________________________</b></td>
  </tr>
  <tr>
  <tr>
    <td><b>Логин администратора:</b></td>
	<td width="150" align="center"><input type="text" name="admin" value="<?=$data_c["admin"]; ?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF"><b>Пароль администратора:</b></td>
	<td width="150" align="center"><input type="text" name="pass" value="<?=$data_c["pass"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость 1 RUB ($):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wmr" value="<?=$data_c["ser_per_wmr"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Стоимость 1 USD ($):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wmz" value="<?=$data_c["ser_per_wmz"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость 1 EUR ($):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wme" value="<?=$data_c["ser_per_wme"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Прибавлять % при обмене (От 1 до 99):</b></td>
	<td width="150" align="center"><input type="text" name="percent_swap" value="<?=$data_c["percent_swap"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>% $ на вывод при продаже (от 1 до 99):</b><BR /></td>
	<td width="150" align="center"><input type="text" name="percent_sell" value="<?=$data_c["percent_sell"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Сколько G/h = 1 0.01$:</b></td>
	<td width="150" align="center"><input type="text" name="items_per_coin" value="<?=$data_c["items_per_coin"]; ?>" /></td>
  </tr>
  
  

  <tr>
    <td><b>Какой доход 1 тарифа Bitcloud:</b></td>
	<td width="150" align="center"><input type="text" name="a_in_h" value="<?=$data_c["a_in_h"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Какой доход 2 тарифа Bitcloud 200+:</b></td>
	<td width="150" align="center"><input type="text" name="b_in_h" value="<?=$data_c["b_in_h"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Какой доход 3 тарифа Bitcloud 500+:</b></td>
	<td width="150" align="center"><input type="text" name="c_in_h" value="<?=$data_c["c_in_h"]; ?>" /></td>
  </tr>
  
  

  <tr>
    <td><b>Стоимость 1 тарифа Bitcloud:</b></td>
	<td width="150" align="center"><input type="text" name="amount_a_t" value="<?=$data_c["amount_a_t"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость 2 тарифа Bitcloud 200+:</b></td>
	<td width="150" align="center"><input type="text" name="amount_b_t" value="<?=$data_c["amount_b_t"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость 3 тарифа Bitcloud 500+:</b></td>
	<td width="150" align="center"><input type="text" name="amount_c_t" value="<?=$data_c["amount_c_t"]; ?>" /></td>
  </tr>
  
  <tr>
  	<td><b>Лимиты 1 тарифа Bitcloud:</b></td>
  	<td width="150" align="center"><input type="text" name="limit_a_t" value="<?=$data_c["limit_a_t"]; ?>" /></td>
  </tr>
  <tr>
  	<td><b>Лимиты на  2 тарифа Bitcloud 200+:</b></td>
  	<td width="150" align="center"><input type="text" name="limit_b_t" value="<?=$data_c["limit_b_t"]; ?>" /></td>
  </tr>
  <tr>
  	<td><b>Лимиты на  3 тарифа Bitcloud 500+:</b></td>
  	<td width="150" align="center"><input type="text" name="limit_c_t" value="<?=$data_c["limit_c_t"]; ?>" /></td>
  </tr>
  
  <tr> <td colspan="2" align="center"><input type="submit" value="Сохранить" /></td> </tr>
</table>
</form>

</div>
</div></div></div>
<div class="clr"></div>	
