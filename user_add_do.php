<?php
session_start();
include('page_header.php');
require_once('db_inc.php');
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 9) {
	// 管理者としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else{
	$uid  = $_POST['uid'];//送信されたuidを受け取り、$uidに代入
	$uname  = $_POST['uname'];//送信されたunameを受け取り、$unameに代入
	$upass  = $_POST['upass'];//送信されたupassを受け取り、$upassに代入
	$urole  = $_POST['urole'];//送信されたuroleを受け取り、$uroleに代入
	$sql = "INSERT INTO tb_user VALUES('$uid','$uname','$upass','$urole')";
	$rs = mysql_query($sql, $conn);
	echo '<h1>アカウントを登録しました</h1>';
}
include('page_footer.php');
?>