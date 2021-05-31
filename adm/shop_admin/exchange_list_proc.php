<?php 
include_once('./_common.php');

if($_POST['chk'] != ""){

$chk = $_POST['chk'];
$sql = "delete from sh_shop_order where no in ( ";
for($i = 0; $i < count($chk); $i++){

  $sql .= "{$_POST['no'][$chk[$i]]} ,";

}


$sql = substr($sql,0,-1);

$sql .= ")";

$result = sql_query($sql);

goto_url("./exchange_list.php");


}else{


$no = $_POST['no'];
$status = $_POST['status'];

$sql = "update sh_shop_order set tot_state = '{$status}', complete_date = now() where no = '{$no}'";
$result = sql_query($sql);

if($result){
    $code = "0001";
    $result = "정상 처리되었습니다.";
}else{
    $code = "0002";
    $result = "문제가 발생하였습니다. 다시 시도해주세요.";
}


echo json_encode(array("code"=>$code,"result"=>$result));
}
?>