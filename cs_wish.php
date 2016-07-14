<?php
require_once('db_inc.php');
/*$sql_time = "SELECT timelimit FROM tb_timelimit";
$rs = mysql_query($sql_time, $conn);
$row = mysql_fetch_array($rs) ;*/
//$timelimit = $row['timelimit'];

session_start();
include('page_header.php');
if ( isset($_SESSION['urole']) and $_SESSION['urole']==1 ) {
	//学生としてログインしているなら
	$uid   = $_SESSION['uid'];   // 認証済みのユーザID
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo '<h2>コース希望登録</h2>';
	echo $uname . '(' .  strtoupper($uid) . ')';   // ログイン中のユーザ氏名とIDを表示
}else { // その以外は
	die('エラー：この機能を利用する権限がありません');
}
echo '<div class="container-fluid">';
echo  	  '<div class="row">';
echo     	'<div class="col-xs-4"></div>';
echo     	'<div class="col-xs-4">';
$courses = array(
1=>'情報技術応用コース',
2=>'情報科学総合コース'
);
//変数の初期化
$cid = 1;         //希望のコースID;
$act = 'insert';  //初回登録?（insert: 初回登録; update: 再登録）;

// ログイン中のユーザ($uid)の希望状況を検索する
$sql = "SELECT cid,wishtext FROM tb_entry WHERE uid = '{$uid}'";
$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;
if ($row) {
	$wishtext = $row['wishtext'];
	$cid = $row['cid']; // 現在登録しているコースのID
	$act = 'update';    // すでに登録したため「再登録」とする
}

if (strtotime(date('Y-m-d H:i')) < strtotime($timelimit)){
echo '<form action="cs_wish_save.php" method="post">';
echo '<input type="hidden" name="act" value="'.  $act .'">'; //非表示送信
foreach ($courses as $id => $name ){
	if ($id == $cid){  //登録状況を反映したラジオボタンを作成
		echo '<input type="radio" name="cid" value='.$id.' checked/>'.$courses[$id];
	}else{
		echo '<input type="radio" name="cid" value='.$id.'>'.$courses[$id];
	}

}
echo'<div class="form-group">';
echo    '<font>自己アピール文:</font>';
if($row['wishtext']){
	echo '<textarea name="wishtext" class="form-control">'.$wishtext.'</textarea>';
}else{
	echo '<textarea name="wishtext" class="form-control"placeholder="自己アピール文を入力しださい"></textarea>';
}

echo    '<input button class="btn btn-default"type="submit" value="送信"/>';
echo '</div>';
echo '</form>';
echo '</div>';
echo        '</div>';
echo     	'<div class="col-xs-4"></div>';
echo	  '</div>';
}else {
echo '<font>締め切り時間を過ぎました</font>';
}
//echo '<h1>自己アピール文：</h1>';//cssで文字の大きさを調整お願いします。
//if($row['wishtext']){
//	echo '<textarea name="wishtext" rows="4" cols="40">'.$wishtext.'</textarea>';
//}else{
//	echo '<textarea name="wishtext" rows="4" cols="40">自己アピール文を入力しださい</textarea>';
//}
//echo '<input type="submit" value="送信"/>';
//echo '</form>';
include('page_footer.php');//画面出力終了
?>