<?PHP
$db->Query("SELECT * FROM db_sender WHERE status = '0' ORDER BY id LIMIT 1");
if($db->NumRows() == 1){
$send_data = $db->FetchArray();
$page = $send_data['page'];
$count = $config->SMTP_COUNT; // РєРѕР»РёС‡РµСЃС‚РІРѕ СЃРѕРѕР±С‰РµРЅРёР№ Р·Р° РѕРґРёРЅ СЂР°Р·

	$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id ORDER BY db_users_a.id LIMIT {$page}, {$count}");

	if($db->NumRows() != 0){
		$sender = new smtp($config);		
		$all_send = 0;
		while($send = $db->FetchArray()){
			$arr_data = array('{!USER_ID!}','{!USER!}', '{!EMAIL!}', '{!PASS!}', '{!REFERER!}', '{!REFERALS!}', '{!denga_b!}', '{!denga_p!}', "\n");
			$arr_data2 = array($send['id'], $send['user'], $send['email'], $send['pass'], $send['referer'], $send['referals'], $send['denga_b'], $send['denga_p'], '<BR />');
			$send_data_text = str_replace($arr_data, $arr_data2, $send_data['mess']);
			$send_data_text = iconv("<center><div style='border: 2px dotted #0e82a7;padding: 5px 10px 2px 10px;border-radius: 5px 5px 5px 5px;'><br>{$send_data_text}<br><br></div></center>");
			$headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html\r\n; charset=".$config->SMTP_CHARSET."\r\n"; // РєРѕРґРёСЂРѕРІРєР° РїРёСЃСЊРјР°
			$headers .= "To: ".$send['user']." <".$send['email'].">\r\n";
            $headers .= "From: ".$config->SMTP_FROM." <".$config->SMTP_USER.">\r\n"; // РѕС‚ РєРѕРіРѕ РїРёСЃСЊРјРѕ
			$sender -> SendMail($send['email'], $send_data['name'], $send_data_text, $headers); // РѕС‚РїСЂР°РІР»СЏРµРј РїРёСЃСЊРјРѕ
			$all_send++;
			echo '[ID '.$send['id'].'] OK<br>';
		}
		$db->Query("UPDATE db_sender SET page = page +'$all_send', sended = sended + '$all_send' WHERE id = '".$send_data["id"]."'");
		$db -> FreeMemory();
	} else {
		echo 'NO USER FOR SEND';
		$db->Query("UPDATE db_sender SET status = '1' WHERE id = '".$send_data["id"]."'");
		$db -> FreeMemory();
	}
	$db -> FreeMemory();
}else{
	echo 'NO DATA FOR SEND';
}
?>