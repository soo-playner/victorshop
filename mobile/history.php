<?php
include_once('./_common.php');
include_once(G5_MOBILE_PATH.'/head.php');

if($wallet_addr == ""){
  alert('입금페이지에서 VCT-K 지갑생성후 이용해주세요.',G5_URL);
  return false;
}

include_once(G5_PATH."/util/callOneCoinHistory.php");

?>

<link href="https://cdn.jsdelivr.net/npm/remixicon@2.4.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="<?=G5_MOBILE_URL?>/css/history.css?ver=20200507">


<!-- ===================================================================================BODY=====================================================================================-->

  <header class="header">
    <a href="javascript:history.back()"><img class="left" src="img/icon_back_bk.png" alt="back_arrow"></a>
    <p class="hd_title">내역보기</p>
  </header>



  <section class="balance" id="js-balance_1">


    <div class="coin_balance">
      <div class="cb_left">
        <div class="coin_img"><img src="<?=$token_img?>" alt="<?=$token_symbol?>"></div>
        <p class="coin_name"><?=$token_symbol?></p>
      </div>

      <div class="cb_right">
        <p class ="token_balance" ></p>
        <p class ="eth_balance"></p>
      </div>

      <p class="guide" >Touch!</p>
    </div>


    <!-- HISTORY -->
    <div id="gtt_history" class="gtt_mainnet gtt_table">
      <table class="hist_tab" id="js-hist_tab_1">
        <thead>
          <tr>
            <th>날짜</th>
            <th>내용</th>
            <th>상태</th>
            <th><?=$token_symbol?></th>
          </tr>
        </thead>

        <tbody></tbody>
      </table></div>
    </section>



    <section class="balance"  id="js-balance_2">
      <div class="coin_balance">
        <div class="cb_left">
          <div class="coin_img"><img src="<?=$point_img?>" alt="<?=$point_symbol?>"></div>
          <p class="coin_name"><?=$point_symbol?></p>
        </div>
        <div class="cb_right">
          <p id="point_balance" class="point_balance"> <? echo (int)$member['mb_1']+(int)$member['mb_2']." MASK"; ?></p>
        </div>
        <p class="guide" >Touch!</p>
      </div>

      <div id="gtt_history">
        <table class="hist_tab" id="js-hist_tab_2">
          <thead>
            <tr>
              <th width="30%">날짜</th>
              <th width="15%">상품명</th>
              <th width="15%">상태</th>
              <th width="20%"><?=$token_symbol?></th>
              <th><?=$point_symbol?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            // echo $mem_id;
            $sql = "SELECT goods_order_total,mask_type,tot_state,coupon_money,datetime FROM g5_shop_order WHERE mb_id = '{$member['mb_id']}' ORDER BY datetime desc";
            $result = sql_query($sql);

            $arr = array("1"=>"결제대기", "2"=>"결제완료", "3"=>"배송중", "4"=>"배송완료", "5"=>"반품신청", "6"=>"반품완료", "7"=>"교환신청",
            "8"=>"교환완료", "9"=>"주문취소<br>(결제전)", "10"=>"주문취소<br>(결제후)", "11"=>"거래완료");

            while($row = sql_fetch_array($result)){


              if($row['tot_state']){
                $status = $arr[$row['tot_state']];
              }
              ?>

              <tr>
                <td width="20%" class="date"><?=$row['datetime']?></td>
                <td width="15%" class="goods_name">MASK <?=$row['mask_type']?></td>
                <td width="15%"><?=$status?></td>
                <td width="20%" class="price"><?=$row['goods_order_total']?><span class='ex_icon'><i class="ri-refresh-line"></i></span></td>
                <td width="30%" class="price"><?=$row['coupon_money']?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </section>




    <!-- 주문내역 -->

    <section class="balance"  id="js-balance_3" style='display:none;'>

      <div class="coin_balance">

        <div class="cb_left">
          <div class="coin_img"><img src="images/shopping_order.png" alt="shopping"></div>
          <p class="coin_name">상품결제 내역</p>
        </div>
        <p class="guide" >Touch!</p>
      </div>


      <div id="gtt_history">
        <table class="hist_tab" id="js-hist_tab_3">
          <thead>
            <tr>
              <th width="20%">날짜</th>
              <th width="auto">상품명</th>
              <th width="10%">수량</th>
              <th>결제금액</th>
            </tr>
          </thead>
          <tbody>

            <?php
            // sh_shop_order 테이블과 sh_shop_order_goods 테이블에서 결제시간으로 정렬한 후 접속아이디와
            // 결제고유넘버로 2개의 테이블에서 공통된 부분을 조회 후 필요한 값들을 출력
            /* $search_goods_order_sql = "select a.goods_name, a.order_qty, a.datetime,b.tot_state,
            b.order_total, b.payment_type, a.goods_no, b.cell_point_amt FROM sh_shop_order_goods AS a
            JOIN sh_shop_order AS b
            where a.mem_id='$mem_id' AND a.order_no=b.no
            ORDER BY datetime desc";

            $search_goods_order_result = mysql_query($search_goods_order_sql);

            if(mysql_num_rows($search_goods_order_result) > 0){

            while ($search_goods_order_row = mysql_fetch_assoc($search_goods_order_result)){

            if($search_goods_order_row['payment_type'] == "1"){
            $payment_what = "무통장 입금";

          }else {
          $payment_what = "카드결제 외";
        }

        if($search_goods_order_row['tot_state'] == 1 || $search_goods_order_row['tot_state'] == 22){
        ?>

        <tr>
        <td width="20%" class="date"><?echo $search_goods_order_row['datetime']?></td> <!-- 결제 시간 -->
        <td width="auto" class="goods_name"><?echo $search_goods_order_row['goods_name']?></td> <!-- 구매 상품명 -->
        <td width="1%"><?echo $search_goods_order_row['order_qty']?> </td> <!-- 구매상품 갯수 -->
        <td width="29%" class="order_total"><span class="price"><?= Number_format($search_goods_order_row['order_total'])?>원<br />(<?=Number_format($search_goods_order_row['cell_point_amt'])?> CELL)</span><br />
        <span class="payment">(<?echo $payment_what?>)</span></td> <!-- 총 결제 금액 및 카드결제인지 무통장인지 구분 -->
        </tr>
        <?}?>
        <?}}
        */
        ?>
      </tbody>
    </table>
  </div>
</section>

<!-- ===================================================================================BODY=====================================================================================-->

<script>

jQuery('#js-balance_1').click(function () {
  if($("#js-hist_tab_1").css("display") == "none"){
    jQuery('#js-hist_tab_1').css("display", "table");
    $(this).find('.guide').css('display','none');
  } else {
    jQuery('#js-hist_tab_1').css("display", "none");
    $(this).find('.guide').css('display','block');
  }
});



jQuery('#js-balance_2').click(function () {
  if($("#js-hist_tab_2").css("display") == "none"){
    jQuery('#js-hist_tab_2').css("display", "table");
    $(this).find('.guide').css('display','none');
  } else {
    jQuery('#js-hist_tab_2').css("display", "none");
    $(this).find('.guide').css('display','block');
  }
});



$('#js-balance_3 .coin_balance').click(function () {
  if($("#js-hist_tab_3 ").css("display") == "none"){
    $('#js-hist_tab_3 ').css("display", "table");
    $(this).find('.guide').css('display','none');
  } else {
    $('#js-hist_tab_3 ').css("display", "none");
    $(this).find('.guide').css('display','block');
  }
});
</script>

<?php
include_once(G5_MOBILE_PATH.'/tail.php');