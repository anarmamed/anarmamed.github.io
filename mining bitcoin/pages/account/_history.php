<style>

</style>
<?PHP
$_OPTIMIZATION["title"] = "Account - Referrals";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();
?>

<div class="history">


  <div class="container">
    <div class="indexx">
      <h1>History of mining powers</h1>
    </div>

    <div class="hist_table">
      <span class="angel">	&#10096;	&#10097;</span>
      <div class="container">
        <table cellpadding='3' cellspacing='0' border='1' bordercolor='#ccc' align='center' width='100%'>
          <tr height='25' valign=top align=center>
            <td class="m-tb">ID</td>
            <td class="m-tb">Mining powers in MH/s</td>
            <td class="m-tb">Amount in $</td>
            <td class="m-tb">Date of operation</td>
            <td class="m-tb">Frozen until</td>
            <td class="m-tb">Buy/Sell</td>
          </tr>

          <?PHP
$all_money = 0;
$db->Query("SELECT * FROM db_sell_items 
WHERE user_id = '$user_id' ORDER BY id ");

if($db->NumRows() > 0){

  while($ref = $db->FetchArray()){
$time_frozen = ($ref["time_frozen"]>time() && $ref["time_frozen"] !=0) ? date("d.m.Y \a\\t H:i:s",$ref["time_frozen"]) : 'not frozen' ;
$buy_sell  = ($ref["buy_sell"] =='1') ? 'Buy' : 'Sell' ;
$font_col  = ($ref["buy_sell"] =='1') ? '<font color="green"><b>' : '<font color="red"><b>' ;
if ($buy_sell == 'Sell' && $ref["time_frozen"]>time()) {
  $buy_sell = 'Frozen';
  $font_col = '<font color="grey"><b>';
}

?>
          <tr height="25" class="htt" valign="top" align="center">
            <td align="center"> <?=$ref["id"]; ?> </td>
            <td align="center"> <?=$font_col ?><?=$ref["a_s"]; ?></b></font> GH/s</td>
            <td align="center"> <?=$font_col ?><?=$ref["amount"]; ?></b></font>$ </td>
            <td align="center"> <?=date("d.m.Y \a\\t H:i:s",$ref["date_add"]); ?> </td>
            <td align="center"> <?=$time_frozen ?> </td>
            <td align="center"> <?=$font_col ?><?=$buy_sell; ?></b></font> </td>
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


</div>
</div>
</div>
<div class="clr"></div>
</div>