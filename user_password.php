<?php
session_start();
include('page_header.php');

if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 9){
	// 管理者としてログインしていなければ
	die('<h1>エラー：この機能を利用する権限がありません</h1>');
}else{
	if (isset($_GET['uid'])){
		$uid = $_GET['uid'];
		echo '<font>ユーザID：<b>'.$uid.'のパスワードをリセットしますか?</b></font><br>';
		echo '<a href="user_password_do.php?uid='. $uid . '">リセット</a> | ';
		echo '<a href="user_list.php">戻る</a>';
	}else{
		echo '<h2>リセットするユーザIDが与えられていません</h2>';
		echo '<a href="user_list.php">戻る</a>';
	}
}
include('page_footer.php');
?>