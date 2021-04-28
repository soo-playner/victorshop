<?
$is_debug = 0;
if(isset($_GET['debug'])){
  $is_debug = 1;
}


$Ether_API_KEY ="V3G3VI316K8BCTGDFQG6QGUAZ4MM1GN9WJ";


$title = "VCT :: Victor wallet";
$header_logo ="/wallet/images/victor/logo_header.png";
$main_logo = "";


/* 모드 설정*/
$pre_sql = "SELECT * FROM wallet_setting ";
$pre_result = sql_query($pre_sql);
$pre_row = sql_fetch($pre_result);
if(strtolower($pre_row['mode']) == 'test'){
    $mode = 'test';
}
if(isset($pre_row['exchange_rate'])){
    $exchange_rate = $pre_row['exchange_rate']; // 교환시 비율
}else{
    $exchange_rate =1;
}

// if(!isset($mode)) $mode = '';
// $mode = 'test';
$encrypt = "Y";

if(strtolower($mode) == 'test'){
    //  테스트모드일때
    define('NETWORK','ropsten');
    define('ETHERSCAN_ENDPOINT','ropsten');
    define('VCT_COMPANY_ADDR','0x5Cc8C164F0cB14bf72E15C8021c27fdEb3313c8a');
    define('VCT_CONTRACT', '0x0b49e59bc424e9f616eb86fd3002757eab4c8a28');
}else{
  define('NETWORK','mainnet');
  define('ETHERSCAN_ENDPOINT','API');
  define('VCT_COMPANY_ADDR','0xAB4f0AaAf747CeFB015D7E21C498aB1f63a06D48');
  define('VCT_CONTRACT', '0x31C785fcbA8429e1E566a0110D75ee42687aac9B');
}

define('Ether_API_KEY','V3G3VI316K8BCTGDFQG6QGUAZ4MM1GN9WJ');
define('PROJECT_ID','56c41b4d65e048f9acb9d73fe5844172');
define('WEB3_ENDPOINT','https://'.NETWORK.'.infura.io/v3/'.PROJECT_ID);


$token_arr = array(
  'vct'=>array(
    'addr'=>VCT_CONTRACT,
    'symbol'=>'VCT-K',
    'coin_img'=>'/img/victor/vct_coin.png',
    'coin_symbol_img'=>'/img/victor/token_symbol_circle.png',
    'decimal'=>'8',
    'decimal_numeric'=>'100000000',
    'color'=>'gold',
    'id'=>'Victor-K'
  )
);

$point_arr = array(
  'symbol'=>'MASK',
  'point_img'=>'/img/victor/point_symbol.png',
  'point_symbol_img'=>'/img/victor/point_symbol_circle.png',
  'color'=>'royalblue',
  'id'=>'mask'
);



if( isset($_REQUEST['token']) ){
  $_token= $token_arr[strtolower($_REQUEST['token'])];
}else{
  $_token= $token_arr['vct'];
}
$token_address = $_token['addr']; // 토큰 컨트렉트
$token_symbol = $_token['symbol']; // 코인 심볼
$token_img = $_token['coin_img']; // 코인이미지
$token_symbol_img = $_token['coin_symbol_img']; // 코인 심볼
$token_decimal = $_token['decimal']; // 자릿수
$token_color = $_token['color']; // 토큰컬러
$token_id = $_token['id']; // 토큰명
$token_decimal_numeric = $_token['decimal_numeric']; // 데시멜 0 갯수

// 포인트
$point_symbol = $point_arr['symbol'];
$point_img = $point_arr['point_img'];
$point_symbol_img = $point_arr['point_symbol_img'];
$point_id = $point_arr['id'];

?>

<?if(strtolower($mode) == 'test'){?>
    <div class='prev_mode' style='background:black;color:white;text-align:center'><?=strtoupper(NETWORK)?> TEST MODE</div>
<?}?>


<script>
    var WEB3_ENDPOINT = "<?=WEB3_ENDPOINT?>";
    var TokenContract = "<?=VCT_CONTRACT?>";
</script>
