<?php

define('TIME', time());
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);

header("Content-type: text/html; charset=utf-8");

session_start();

if (!isset($_SESSION['user_id'])) { exit(); }

function __autoload($name){ include(BASE_DIR."/classes/_class.".$name.".php");}

$config = new config;

$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
$db->Query("set names utf8;");

$db->Query("SELECT * FROM db_users_b WHERE id = '".$_SESSION['user_id']."'");
$users_info = $db->FetchAssoc();

//print_r($_POST);

if (isset($_POST['cnt']) && $_POST['cnt'] == $_SESSION['cnt'])
{
  $user_name = $_SESSION['user'];
  $adv = isset($_POST['adv']) ? (int) $_POST['adv'] : 0; 
  $mode = isset($_POST['mode']) ? (int) $_POST['mode'] : 0; 
  $use = isset($_POST['use']) ? (int) $_POST['use'] : 0;
    
  if (!$adv && !$mode && !$use) exit('no1');
  
  if (isset($_SESSION['admin']))
  {
    $db->query("SELECT * FROM db_serfing WHERE id = '".$adv."'"); 
  } 
  else
  { 
    $db->query("SELECT * FROM db_serfing WHERE user_name = '".$user_name."' and id = '".$adv."'"); 
  }  
  
  if (!$db->NumRows()) exit('no2');
  
  $result = $db->FetchAssoc(); 
  
  switch ($use)
  {
    //Р·Р°РїСѓСЃРє
    case 1:
    
    if ($result['status'] == 3 && $result['money'] >= $result['price']) 
    {     
      $db->query("UPDATE db_serfing SET status = '2' WHERE id = '".$adv."'");       
        
      exit('1');
    }  
    
    break;
    
    //РїР°СѓР·Р°
    case 2:
    
    if ($result['status'] == 2) 
    {      
      $db->query("UPDATE db_serfing SET status = '3' WHERE id = '".$adv."'");       
        
      exit('1');
    }  
    
    break;
   
    //РѕС‡РёСЃС‚РєР° РїСЂРѕСЃРјРѕС‚СЂРѕРІ
    case 3:
    
    if ($result['view'] > 0) 
    { 
      $db->query("UPDATE db_serfing SET view = '0' WHERE id = '".$adv."'");       
        
      exit('1');   
    }  
    
    break;
    
    //СѓРґР°Р»РµРЅРёРµ
    case 4:
    
    if ($result['money'] > 0) exit('no3'); 
    
    if ($mode == 2) exit();
    
    $db->query("DELETE FROM db_serfing WHERE id = '".$adv."'");       
     
    $db->query("DELETE FROM db_serfing_view WHERE ident = '".$adv."'"); 
    
    exit('1');    
    
    break;
  
    //СЃРєРѕСЂРѕСЃС‚СЊ РїСЂРѕСЃРјРѕС‚СЂРѕРІ
    case 5:

    $speed = ($result['speed'] + 1) <= 7 ? $result['speed'] + 1 : 1; 
      
    $db->query("UPDATE db_serfing SET speed = '".$speed."' WHERE id = '".$adv."'");       
        
    exit(''.$speed.'');     
    
    break;
    
    //РѕС‚РїСЂР°РІРєР° РЅР° РјРѕРґРµСЂР°С†РёСЋ
    case 6:

    if ($result['status'] == 0)  
    {  
      $db->query("UPDATE db_serfing SET status = '3' WHERE id = '".$adv."'");        
   
      exit('1'); 
    }     
      
    break;
    
    //РѕРґРѕР±СЂРµРЅРёРµ РјРѕРґРµСЂРѕРј
    case 10:

    if ($result['status'] == 1)  
    {  
      $db->query("UPDATE db_serfing SET status = '3' WHERE id = '".$adv."'");        
   
      exit('1'); 
    }     
      
    break;
    
    //СѓРґР°Р»РµРЅРёРµ РјРѕРґРµСЂРѕРј
    case 11:

    $db->query("DELETE FROM db_serfing WHERE id = '".$adv."'");
    $db->query("DELETE FROM db_serfing_view WHERE ident = '".$adv."'"); 
     
    exit('1'); 
              
    break;
   
    //РїРѕРїРѕР»РЅРµРЅРёРµ Р±Р°Р»Р°РЅСЃР°
    case 12:

    $money = floatval($_POST['price']); 
    
    if ($money <= 0) exit('YOU BAD CHEL )))'); 
     
    if ($_SESSION['admin']) 
    { 
      $db->query("UPDATE db_serfing SET `money` = `money` + '".$money."' WHERE id = '".$adv."'"); 
      
      exit('1');
    } 
    else
    {
      if ($users_info['money_serf'] >= $money) 
      { 
           
        $db->query("UPDATE db_serfing SET `money` = `money` + '".$money."' WHERE id = '".$adv."'");  
     
        $db->query("UPDATE db_users_b SET `money_serf` = `money_serf` - '".$money."'	WHERE id = '".$_SESSION['user_id']."'");
    
        exit('1'); 
      } 
      else
      {
        exit('РќРµРґРѕСЃС‚Р°С‚РѕС‡РЅРѕ СЃРµСЂРµР±СЂР° РїРѕРїРѕР»РЅРёС‚Рµ  СЃС‡С‘С‚ РґР»СЏ СЃРµСЂС„РёРЅРіР°<br>РџРµСЂРµР№С‚Рё Рє РїРѕРїРѕР»РЅРµРЅРёСЋ <a href="/account/insert_serf">РїРѕРїРѕР»РЅРёС‚СЊ</a>');
      }
    } 
              
    break;

    default:
    break;
  }
}  

exit('no4');
?>