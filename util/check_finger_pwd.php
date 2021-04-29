<?php
include_once('./_common.php');

$mb_id = $_POST['user_id'];
$mb_pwd = $_POST['user_pwd'];

$sql = "SELECT mb_id,mb_password FROM g5_member WHERE mb_id = '$mb_id' AND mb_password = PASSWORD('$mb_pwd')";
$result = sql_query($sql);

$count = sql_num_rows($result);

if($count > 0){
  echo json_encode(array("result"=>"OK"));
}else{
  echo json_encode(array("result"=>"FAIL"));
}
?>
