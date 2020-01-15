<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Настройки";
$usid = $_SESSION["user_id"];

$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_b.id = db_users_a.id AND db_users_b.id = '$usid'");
$user_data = $db->FetchArray();
?>


<div class="settings">
    <div class="indexx ">
      <h1>Settings</h1>
    </div>
    <div class="container settings_block">
      <div class="row">
        <div class="col-md-6">
          <!-- <img class="sleza marbot" src="/img/avatar/<?=$user_data["avatar"];?>" width="100" height="100"/>
            <BR />
            <p><a class="sumserf-a" href="/account/chooseava">Изменить Аватар. </a></p> -->

          <h2>Change Password</h2>



          <?PHP
    if(isset($_POST["old"])){
    
      $old = $func->IsPassword($_POST["old"]);
      $new = $func->IsPassword($_POST["new"]);
      
        if($old !== false AND strtolower($old) == strtolower($user_data["pass"])){
        
          if($new !== false){
          
            if( strtolower($new) == strtolower($_POST["re_new"])){
            
              $db->Query("UPDATE db_users_a SET pass = '$new' WHERE id = '$usid'");
              echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='left: -500px; transition: all 1s ease;'>New password successfully set!</div>";
            
            }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Password and password replay do not match!</div>";
          }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>The new password is in the wrong format!</div>";
        
        }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>The old password is entered incorrectly!".$old_from_bd." and ".$old."</div>";
      
    }
    // Платежный пароль
    /*if(isset($_POST["plat_pass"])){
      
      function plat_passs($plat_passs){
        if(!preg_match("/^[0-9]{4}$/", $plat_passs)) return false;
        return $plat_passs;
      }
      $plat_passs = plat_passs($_POST["plat_pass"]);
      $plat_pass = $plat_passs;
      if($plat_passs !== false){
        if($user_data['plat_pass'] == 0) {
        $db->Query("UPDATE db_users_a SET plat_pass = '$plat_pass' WHERE id = '$usid'");
        echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='left: -500px; transition: all 1s ease;'>Новый платежный пароль успешно установлен!</div>";
        } else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Упс!</div>"; 
      }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Платежный пароль имеет неверный формат!</div>";
    }*/
  ?>

          <div class="form_pass">
            <form class="d-flex justify-content-center flex-column" action="" method="post">
              <label for="old">Old password:</label>
              <input type="password" name="old" />
              <label for="new">New password:</label>
              <input type="password" name="new" />
              <label for="re_new">Re-enter new password:</label>
              <input type="password" name="re_new" />
              <span class="reg_span">The Password field must be between 6 and 20 characters (English characters
                only)</span>
              <input class="int_main btn-primary" type="submit" value="Change Password" />
            </form>
          </div>
        </div>


        <!-- <hr>
  <h2><b>Настройки Платежного пароля</b></h2>
  </hr>
  
  <?php
  if($user_data['plat_pass'] != 0) {
    echo '<font color="green">Вы уже установили платежный пароль! Для его смены обратитесь в службу поддержки!</font><br><br>';
  } else {
    ?>
    <form action="" method="post">
      <table  border="0" align="center">
        <tr>
          <b>Платежный пароль(обязательно):</b>
          <td align="center"><input type="text" name="plat_pass" /></td>
        </tr>
        <tr>
          <td><font style="font-size: 1.7vw; " color="red">Платежный пароль должен состоять строго из четырех цифр!</font></td>
          
        </tr>
        <tr>
          <td align="center" colspan="2"><BR /><input class="ui-button ui-corner-all" type="submit" value="Сохранить платежный пароль" /></td>
        </tr>
      </table>
    </form> -->

        <?php 
  } 
  ?>



        <!-- <hr>
  <center><h2><b>Payeer wallet settings</b></h2>
    <div class="cryp">
      <?php if ($user_data["payeer_wallet"]!='0') { ?>
        Wallet Installed: <?=$user_data["payeer_wallet"]?>&nbsp;&nbsp;&nbsp;
        <?php } ?>
  
    </div>
    <form action='' method='POST'>
    <input type='text' name='payeer_wallet' placeholder='P11111111' style='font-size: 1.2vw; width:12vw; height: 2.8vw; text-align: center;'/>
    <input class='int_main' type='submit' name='save_payeer_wallet' value='Save Payeer'/>
    </form>
    </center>
  
  <?php 
  function rightPurse($wallet){
      
      if( substr($wallet,0,1) != "P" ) return false;
      if( !ereg("^[0-9]{7,10}$", substr($wallet,1)) ) return false;  
      return $wallet;
  }
  if (isset($_POST["save_payeer_wallet"])) {
    $wallet=rightPurse($_POST["payeer_wallet"]);
    if($wallet !== false){
    $db->Query("SELECT COUNT(*) FROM db_users_b WHERE payeer_wallet='$wallet'");
    $walletcanreg=$db->FetchRow();
    if ($walletcanreg==0) {
      
      $db->Query("UPDATE db_users_b SET payeer_wallet='$wallet' WHERE id = '$usid'");
    echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='left: -500px; transition: all 1s ease;'>Wallet successfully added!</div>";    
    
    } else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>A user with such a wallet already exists!</div>";  
      } else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>The wallet was entered incorrectly!</div>";  
  } ?> -->
        <div class="col-md-6">
          <h3>PerfectMoney wallet settings</h3>
          <div class="perfect_money">


            <!-- Указание кошелька Perfect Money -->

            <div class="cryp">
              <?php if ($user_data["perfect_wallet"]!='0') { ?>
              Wallet Installed: <?=$user_data["perfect_wallet"]?>&nbsp;&nbsp;&nbsp;
              <?php } ?>
            </div>

            <div class="money">
              <form class="d-flex justify-content-center flex-column" action='' method='POST'>
                <input class='mb-3' type='text' name='perfect_wallet' placeholder='U11111111' />
                <input class='int_main btn-primary' type='submit' name='save_perfect_wallet'
                  value='Save PerfectMoney' />
              </form>
            </div>
          </div>

          <?php 
  function rightPerfect($wallet){
  
  if( substr($wallet,0,1) != "U" ) return false;
  if( !ereg("^[0-9]{7,9}$", substr($wallet,1)) ) return false;  
  return $wallet;
  }
  
  if (isset($_POST["save_perfect_wallet"])) {
  $wallet2=rightPerfect($_POST["perfect_wallet"]);
  if($wallet2 !== false){
  $db->Query("SELECT COUNT(*) FROM db_users_b WHERE perfect_wallet='$wallet2'");
  $walletcanreg2=$db->FetchRow();
  if ($walletcanreg2==0) {
  
  $db->Query("UPDATE db_users_b SET perfect_wallet='$wallet2' WHERE id = '$usid'");
  echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='left: -500px; transition: all 1s ease;'>Wallet successfully added!</div>";    
  
  } else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>A user with such a wallet already exists!</div>";  
  } else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>The wallet was entered incorrectly!</div>";  
  }?>
        </div>
      </div>
    </div>
    <div class="clr"></div>
  </div>
</div>





<style>
  /*Выплывающие окна*/
  element.style {
    left: 50%;
    transition: all 1s ease;
  }


  .message {
    border: 2px solid #551b10;
    border-radius: 8px;
    box-shadow: 0 0 10px black;
    box-sizing: border-box;
    color: white;
    left: -500px;
    margin-left: -210px;
    padding: 10px;
    position: fixed;
    text-align: center;
    text-shadow: 0 0 2px white;
    top: 100px;
    width: 550px;
    z-index: 9999;
  }

  .m-red {
    background-color: red;

  }

  .m-green {
    background-color: #27C224;
  }
</style>