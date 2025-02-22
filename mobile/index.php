<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_member){
	goto_url(G5_BBS_URL."/login.php");
}else{
	echo "<script>App.sendUserId('{$member['mb_id']}');</script>";
}


if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

include_once(G5_MOBILE_PATH.'/head.php');
$notice_sql = "select wr_subject from g5_write_notice order by wr_id desc";
$notice_row = sql_fetch($notice_sql);
?>
<style>
	.symbol_icon{background:#111;width:34px;height:34px;border-radius:50px;display:inline-block;margin-right:5px;text-align:center}
	.symbol_icon i {color:gold;font-size:26px;line-height:34px;vertical-align:middle;margin-top:10px;}
</style>
<section class="breadcomp">
    <h2 class="greeting"><span><?=$member['mb_name']?></span> 님 안녕하세요</h2>
    <div class='row'>
        <dt class='col-4 coin_img'>
            <img src="<?=$token_img?>" alt="<?=$token_symbol?>">
        </dt>
        <dd class='col-8 balance'>
            <p class="token_balance"></p>
            <p class="eth_balance"></p>
        </dd>
    </div>
</section>


<main>

    <div id="main_card">
            <a href="/page.php?id=deposit"><div class='dual left'><img src="<?=$token_symbol_img?>" alt=""> <?=$token_symbol?></div></a>
            <a href="http://www.victorscore.com"><div class='dual right'>
			<span class='symbol_icon'><i class="ri-gamepad-line" style="font-weight:500;font-size:24px;"></span></i>E스포츠 예측게임</div></a>
            <!-- <div class="wallet_link_bar"></div> -->
    </div>


    <div class="notice">
		<div class="notice_inner">
			<a href="/bbs/board.php?bo_table=notice">
				<p><b>공지사항</b>
					<img src="/img/victor/dot_yellow.png" alt=""> <?=$notice_row['wr_subject']?>
				</p>
			</a>
		</div>
	</div>

    
	<section class="menu">
		<div class="menu_box row1">
			<a href="/page.php?id=deposit" class='menu_card'>
				<div class="deposit ">
					<i class="ri-login-circle-line main_icon"></i>
				</div>
				<p>입금</p>
			</a>
			<!-- <a href="/page.php?id=exchange" class='menu_card'>
				<div class="exchange">
					<i class="ri-shopping-bag-line main_icon"></i>
				</div>
				<p>교환하기</p>
			</a> -->
			<a href="/shop" class='menu_card'>
				<div class="exchange">
					<i class="ri-shopping-bag-line main_icon"></i>
				</div>
				<p>주문하기</p>
			</a>
			<a href="/page.php?id=withdraw" class='menu_card'>
				<div class="withdrawl">
				<i class="ri-logout-circle-r-line main_icon"></i>
				</div>
				<p>출금하기</p>
			</a>
			<a href="/page.php?id=history" class='menu_card'>
				<div class="history">
					<i class="ri-scan-line main_icon"></i>
				</div>
				<p>거래내역</p>
			</a>
		</div>


        <div class="menu_box sysbtnset">
			<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">
				<div class="my_info">
				</div>
				<p>내 정보</p>
			</a>
			<a href="<?=G5_BBS_URL?>/logout.php">
				<div class="logout">
				</div>
				<p>로그아웃</p>
			</a>
			</a>
			<div class="sysbtnset_bar"></div>
		</div>

</main>

<!-- 메인화면 최신글 시작 -->
<!-- <?php
//  최신글
$sql = " select bo_table
            from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
            where a.bo_device <> 'pc' ";
if(!$is_admin) {
    $sql .= " and a.bo_use_cert = '' ";
}
$sql .= " order by b.gr_order, a.bo_order ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 스킨은 입력하지 않을 경우 관리자 > 환경설정의 최신글 스킨경로를 기본 스킨으로 합니다.

    // 사용방법
    // latest(스킨, 게시판아이디, 출력라인, 글자수);
    echo latest('basic', $row['bo_table'], 12, 25);
}
?> -->
<!-- 메인화면 최신글 끝 -->

<?php
include_once(G5_MOBILE_PATH.'/tail.php');