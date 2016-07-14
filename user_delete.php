<?php
session_start();
include('page_header.php');
require_once('db_inc.php');
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 9){
	// 管理者としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else{
	if (isset($_GET['uid'])){
		$uid = $_GET['uid'];
		echo '<h2>'. $uid . 'を本当に削除しますか?</h2>';
		echo '<a href="user_delete_do.php?uid='. $uid . '">削除</a> | ';
		echo '<a href="user_list.php">戻る</a>';
	}else{
		echo '<font class="danger">※アカウント一覧から操作してください</font>';
		echo '<h2>削除するユーザIDが与えられていません</h2>';
		echo '<a href="user_list.php">戻る</a>';
	}
}
include('page_footer.php');
?>