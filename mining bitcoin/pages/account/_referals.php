<style>

</style>
<?PHP
$_OPTIMIZATION["title"] = "Account - Referrals";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();
?>
<div class="container referals">
  <div class="indexx">
    <h1>Referals</h1>
  </div>

  <div class="ref_block">
    <div class="invite">
      <p>
        Invite friends and acquaintances to our project and get <strong>1%</strong> from the purchase of mining in our
        project!
      </p>
    </div>

    <div class="ref_link">
      <h2>Your referral link:</h2>
      <p>https://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?></p>
    </div>
  </div>


  <div class="ref_table">
    <div class="indexx">
      <h3>The number of your referrals: <strong><?=$refs; ?> users</strong> </h3>
      <span class="angel">	&#10096;	&#10097;</span>
    </div>
    <div class="container">
      <table cellpadding='3' cellspacing='0' border='1' bordercolor='#ccc' align='center' width='100%'>
        <tr align='center'>
          <td class="m-tb"> Login</td>
          <td class="m-tb"> Date of registration </td>
          <td class="m-tb"> Come from</td>
          <td class="m-tb"> Income in $</td>
          <td class="m-tb"> Mining powers</td>
          <td class="m-tb"> Insert in $</td>
          <td class="m-tb"> Payment in $</td>
        </tr>

        <?PHP
  $all_money = 0;
  $db->Query("SELECT db_users_a.user, db_users_a.date_reg, db_users_a.refsite, db_users_b.to_referer, db_users_b.a_t, db_users_b.insert_sum, db_users_b.payment_sum FROM db_users_a, db_users_b 
  WHERE db_users_a.id = db_users_b.id AND db_users_a.referer_id = '$user_id' ORDER BY db_users_b.to_referer DESC");
  
  if($db->NumRows() > 0){
  
      while($ref = $db->FetchArray()){
    
    ?>
        <tr height="25" class="htt" valign="top" align="center">

          <td align="center"> <?=$ref["user"]; ?> </td>
          <td align="center"> <?=date("d.m.Y in H:i:s",$ref["date_reg"]); ?> </td>
          <td align="center"> <?=$ref["refsite"]; ?> </td>
          <td align="center"> <?=sprintf("%.2f",$ref["to_referer"]); ?>$ </td>
          <td align="center"> <?=$ref["a_t"]; ?>0 GH/s </td>
          <td align="center"> <?=round($ref["insert_sum"],2); ?>$ </td>
          <td align="center"> <?=round($ref["payment_sum"],2); ?>$ </td>

        </tr>

        <?PHP
    $all_money += $ref["to_referer"];
    }
  
  }else echo '<tr><td align="center" colspan="3">You don\'t have referrals</td></tr>'
  ?>

      </table>
    </div>

  </div>

</div>

<!-- ============================================== -->





</div>
</div>
</div>
<div class="clr"></div>
</div>