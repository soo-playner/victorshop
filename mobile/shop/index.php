<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_MSHOP_PATH.'/_head.php');
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>



<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
<?php echo display_banner('왼쪽', 'boxbanner.skin.php'); ?>

<!-- <div id="ssch_cate">
        <ul>
        <li><a href="#" onclick="set_ca_id('20'); return false;">생활/건강 <span>2</span></a></li>
        <li><a href="#" onclick="set_ca_id(''); return false;">전체분류 <span>2</span></a></li>
    </ul>
</div> -->

<div id="gnb" class="gnbslider">
    <div class='rows'> 
    <?php
    $i = 0;
    foreach($mshop_categories as $cate1){
        if( empty($cate1) ) continue;

        $mshop_ca_row1 = $cate1['text'];
        if($i == 0)
            echo '<ul class="cate"><a href="/shop" class="menu_icon"><i class="ri-home-4-line"></i></a>'.PHP_EOL;
    ?>
        <li>
            <a href="<?php echo $mshop_ca_row1['url']; ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
        </li>
    <?php
    $i++;
    } 
    if($i > 0) echo '</ul>'.PHP_EOL;
    ?>
    </div>
</div>
<style> 
    .gnbslider {display:block;background:white;width:100%;max-width:100%;overflow-x: auto;-webkit-overflow-scrolling: touch;}
    .gnbslider .rows{width:max-content;}
    /* .gnbslider{ -ms-overflow-style: none; scrollbar-width: none; }  */
    .gnbslider::-webkit-scrollbar{ scrollbar-height: 0 !important; }

</style>


<div style='clear:both'></div>

    <?php if($default['de_mobile_type1_list_use']) { ?>
    <div class="sct_wrap">
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h2>
        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(1);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', false);
        echo $list->run();
        ?>
    </div>
    <?php } ?>



    <?php if($default['de_mobile_type2_list_use']) { ?>
    <div class="sct_wrap">
        <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(2);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </div>
    <?php } ?>


    <?php if($default['de_mobile_type3_list_use']) { ?>
    <div class="sct_wrap">
        <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품</a></h2>
        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(3);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </div>
    <?php } ?>

    <?php if($default['de_mobile_type4_list_use']) { ?>
    <div class="sct_wrap">
        <!-- <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2> -->
        <?php
        // $list = new item_list();
        // $list->set_mobile(true);
        // $list->set_type(4);
        // $list->set_view('it_id', false);
        // $list->set_view('it_name', true);
        // $list->set_view('it_cust_price', false);
        // $list->set_view('it_price', true);
        // $list->set_view('it_icon', false);
        // $list->set_view('sns', false);
        // echo $list->run();
        ?>
    </div>
    <?php } ?>

    <?php if($default['de_mobile_type5_list_use']) { ?>
    <div class="sct_wrap">
        <!-- <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h2> -->
        <?php
        // $list = new item_list();
        // $list->set_mobile(true);
        // $list->set_type(5);
        // $list->set_view('it_id', false);
        // $list->set_view('it_name', true);
        // $list->set_view('it_cust_price', false);
        // $list->set_view('it_price', true);
        // $list->set_view('it_icon', false);
        // $list->set_view('sns', false);
        // echo $list->run();
        ?>
    </div>
    <?php } ?>

        


    <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>

    <!-- 커뮤니티 최신글 시작 { -->
    <section id="sidx_lat">
        <?php echo latest('shop_basic', 'notice', 3, 30); ?>
    </section>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');