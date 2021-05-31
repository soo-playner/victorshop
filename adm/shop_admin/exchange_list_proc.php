<?php 
include_once('./_common.php');

$chk = $_POST['chk'];
$sql = "delete from sh_shop_order where no in ( ";
for($i = 0; $i < count($chk); $i++){

  $sql .= "{$_POST['no'][$chk[$i]]} ,";

}


$sql = substr($sql,0,-1);

$sql .= ")";

$result = sql_query($sql);

goto_url("./exchange_list.php");
?>