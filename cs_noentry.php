<?php
require_once('db_inc.php');
session_start();
include('page_header.php');//画面出力開始
if ( isset($_SESSION['urole']) and $_SESSION['urole']!=2 ) {
	die('エラー：この機能を利用する権限がありません');
}else { // その以外は
	$uid   = $_SESSION['uid'];
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
	echo '<div class="container-fluid">';
	echo  	  '<div class="row">';
	echo     	'<div class="col-xs-3"></div>';
	echo     	'<div class="col-xs-6">';

	echo '<div style = "text-align:center">';
	//上のsql2はVIEW化する。
	if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=2 ) {
		// 教員でなければ
		die('<h2>エラー：この機能を利用する権限がありません</h2>');
	}else {
		echo '<h2>コース希望未提出者一覧</h2>';
		$sql = "SELECT uid,uname,GPA,取得単位
FROM vw_people NATURAL JOIN tb_user
WHERE urole = 1 AND uid NOT IN(
SELECT uid FROM tb_entry WHERE urole = 1)ORDER BY uid";

		$rs = mysql_query($sql, $conn);
		if (!$rs) {
			die ('エラー: ' . mysql_error());
		}
		$row = mysql_fetch_array($rs) ;

		echo '<table class="table table-hover table table-bordered">';
		//echo '<table border=1>';
		echo '<tr><th>'.'ユーザID'.'</th><th>'.'名前'.'</th><th>'.'取得単位数'.'</th><th>'.'GPA'.'</th></tr>';
		$row = mysql_fetch_array($rs) ;
		while($row){
			echo '<td>' .strtoupper($row['uid']). '</td>';
			echo '<td>' .$row['uname']. '</td>';
			echo '<td>' .$row['取得単位']. '</td>';
			echo '<td>' .$row['GPA']. '</td>';
			echo '</tr>';
			$row = mysql_fetch_array($rs) ;
		}
		echo '</table>';
		echo '</div>';

		echo        '</div>';
		echo     	'<div class="col-xs-3"></div>';
		include('page_footer.php');
	}
}
?>