<form method='post'>
    <input type='text'  name='reg'>
</form>
<?php
if (isset($_POST['reg']))
    echo $_POST['reg'];
else
    echo "false";
  ?>