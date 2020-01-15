<?PHP

class life_time
{


	function __construct($db)
	{
		$this->db = $db;
	}


	private function GetTimeLife($name)
	{
		switch ($name) 
		{
			case 'a_t':   // Чайка «Стелс»
				return 60*60*24*20; // 20 дней
			break;

			case 'b_t':  // Рыбак Михалыч
				return 60*60*24*40; // 40 дней
			break;
			
			case 'c_t':  // Александр Рыбак
				return 60*60*24*60; // 60 дней
			break;

			case 'd_t': // Лодка «Заноза»
				return 60*60*24*80; // 80 дней
			break;

			case 'e_t': // Рыбкорабль «ГАЛЯ»
				return 60*60*24*100; // 100 дней
			break;
			case 'f_t': // Бонусник «Дрифтер Май»
				return 60*60*24*25; // 25 дней
			break;
			case 'g_t': // Кот Семен
				return 60*60*24*20; // 30 дней
			break;
			
			case 'h_t': // Проглот Бобер
				return 60*60*24*40; // 40 дней
			break;
			
			case 'i_t': // Косолапый
				return 60*60*24*60; // 60 дней
			break;

			case 'j_t': // Сын Бывалого
				return 60*60*24*80; // 80 дней
			break;

			case 'k_t': //Бывалый
				return 60*60*24*100; // 100 дней
			break;

			case 'l_t': //Бонусник 2 Гарпунщик
				return 60*60*24*100; // 100 дней
			break;

			case 'm_t': // Шальной Джо
				return 60*60*24*30; // 23 дней
			break;

			case 'n_t': // Рыбачка Соня
				return 60*60*24*88; // 100 дней
			break;
			
			case 'o_t': // Безумный Макс
				return 60*60*24*50; // 50 дней
			break;
			
			case 'p_t': // Удильщик Ванька
				return 60*60*24*45; // 45 дней
			break;
			
			case 'r_t': // Селезень Аркаша
				return 60*60*24*35; // 35 дней
			break;
			
			case 's_t': // Ульян
				return 60*60*24*30; // 30 дней
			break;
			
			case 't_t': // Червяк Стенли
				return 60*60*24*30; // 30 дней
			break;

			case 'u_t': // Хохлатый Аксель
				return 60*60*24*30; // 30 дней
			break;

			case 'v_t': // Жорик
				return 60*60*24*30; // 30 дней
			break;

			case 'w_t': // Хапуга
				return 60*60*24*30; // 30 дней
			break;

			case 'x_t': // Бодрый Азуми
				return 60*60*24*30; // 30 дней
			break;

			case 'q_t': // Страховка 1
				return 60*60*24*120; // 30 дней
			break;

			case 'y_t': // Страховка 2
				return 60*60*24*100; // 30 дней
			break;

			case 'z_t': // Страховка 3
				return 60*60*24*80; // 30 дней
			break;
			
			default:
				return 60*60*24; // время по умолчанию для всех фруктов 24 часа
			break;
		}
	}


	private function GetNameItem($name)
	{
		switch ($name) 
		{
			case 'a_t':
				return "<img width='80' src='/images/bird-fish.png'>";
			break;

			case 'b_t':
				return "<img width='80' src='/images/muhalych.png'>";
			break;

			case 'c_t':
				return "<img width='80' src='/images/boat.png'>";
			break;
			
			case 'd_t':
				return "<img width='80' src='/images/zanoza.png'>";
			break;

			case 'e_t':
				return "<img width='80' src='/images/vipship.png'>";
			break;

			case 'f_t':
				return "<img height='70' src='/images/drift.png'>";
			break;

			case 'g_t':
				return "<img width='80' src='/images/6semen.png'>";
			break;
			case 'h_t':
				return "<img width='80' src='/images/7bober.png'>";
			break;
			case 'i_t':
				return "<img width='80' src='/images/8kosolapy.png'>";
			break;
			case 'j_t':
				return "<img width='80' src='/images/9sonbyvaly.png'>";
			break;
			case 'k_t':
				return "<img width='80' src='/images/10byvaly.png'>";
			break;
			case 'l_t':
				return "<img width='80' src='/images/garpun.png'>";
			break;
			case 'm_t':
				return "<img height='80' src='/images/m_t.png'>";
			break;
			case 'n_t':
				return "<img width='50' src='/images/sonia.png'>";
			case 'o_t':
				return "<img width='50' src='/images/max.png'>";
			case 'p_t':
				return "<img width='50' src='/images/vania_c.png'>";
			case 'r_t':
				return "<img width='50' src='/images/duck.png'>";
			case 's_t':
				return "<img height='60' src='/images/ulian.png'>";
			case 't_t':
				return "<img width='50' src='/images/wormm.png'>";
			break;
			case 'u_t':
				return "<img height='60' src='/images/u_t.png?2'>";
			break;
			case 'v_t':
				return "<img height='60' src='/images/v_t.png'>";
			break;
			case 'w_t':
				return "<img height='70' src='/images/w_t.png'>";
			break;
			case 'x_t':
				return "<img height='60' src='/images/x_t.png'>";
			break;
			case 'q_t':
				return "<img height='60' src='/images/q_t.png'>";
			break;
			case 'y_t':
				return "<img height='60' src='/images/y_t.png'>";
			break;
			case 'z_t':
				return "<img height='60' src='/images/z_t.png'>";
			break;

			default:
				return $name;
			break;
		}
	}


	public function AddItem($user_id, $name, $time=0)
	{
		$db = $this->db;
		$now = time();
		if ($time==0) $del = $now + $this->GetTimeLife($name);
		else
			$del = $now + $time;
		$sql = "insert into `db_product_time` 
				(`id_user`, `name`, `date_add`, `date_del`, `status`)
				values
				($user_id, '$name', $now, $del, 1)";
		$db->Query($sql);
		return ($db->LastInsert()>0);
	}


	public function CheckTime($usid)
	{
		$db = $this->db;
		$now = time();
		$sql = "select * from `db_product_time` where `status`=1 and `date_del`<=$now and `id_user`=$usid";
		$db->Query($sql);
		$arr = array();
		if ($db->NumRows()>0)
		{
			while($row = $db->FetchArray()) 
			{
				$arr[] = $row;
			}
		}
		if (count($arr)>0)
		{
			foreach ($arr as $row) 
			{
				$id = $row['id'];
				$par = $row['name'];
				$user = $row['id_user'];
				$sql = "update `db_users_b` set `$par`=`$par`-1 where `id`=$user";
				$db->Query($sql);
				$sql = "update `db_product_time` set  `status`=0 where `id`=$id";
				$db->Query($sql);
			}
		}
	}

	private function ConvertTime($val)
	{
		$time = (int)$val;
		$m = floor($time / 60);
		$h = floor($m / 60);
		$d = floor($h / 24);
		$h = $h - $d*24;
		$m = $m - $d*24*60 - $h*60;
		$s = $time - $m*60 - $h*60*60 - $d*24*60*60;
	   if($d != 0) return "$d дн $h ч $m мин";
	   if($h != 0) return "$h ч $m мин $s сек";
	   if($m != 0) return "$m мин $s сек";
	   if($s != 0) return "$s сек";
	}


	public function GetTable($user_id)
	{
		$style = "<style></style>";
		$db = $this->db;
		echo $style;
		$sql = "select * from `db_product_time` where `status`=1 and `id_user`=$user_id";
		$db->Query($sql);
		while($row = $db->FetchArray()) 
		{
			$tim = (int)$row['date_del']-time();
			$tim = $this->ConvertTime($tim);
			echo "<div class='info_block'>";
				echo "<div>";
				echo $this->GetNameItem($row['name'])." - осталось: ".$tim;
				echo "</div>";
			echo "</div>";
		}
	}

}