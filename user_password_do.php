<?php
session_start();
include('page_header.php');
include ('db_inc.php');
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 9){
	// 管理者としてログインしていなければ
	die('<h1>エラー：この機能を利用する権限がありません</h1>');
}else{
	if (isset($_GET['uid'])){
		$uid = $_GET['uid'];
		$sql_update = "UPDATE tb_user set upass = 'abcd'WHERE uid = '$uid'";
		$rs = mysql_query($sql_update, $conn);
		echo '<h2>'.$uid.'のパスワードのリセットが完了しました！</h2>';
		echo '<a href="user_list.php">戻る</a>';
	}else{
		//echo $uid;
		echo '<h1>削除するユーザIDが与えられていません</h1>';
		echo '<a href="user_list.php">戻る</a>';
	}
}
include('page_footer.php');
?>