<?php
require_once ('db_inc.php');  // データベース接続
session_start();
include('page_header.php');

if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=2 ) {
	// 教員としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else {
	$courses = array(
	1=>'情報技術応用コース',
	2=>'情報科学総合コース');
	$sql = "SELECT * FROM tb_result";
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs) ;
	echo '<div class="container-fluid">';
	echo  	  '<div class="row">';
	echo     	'<div class="col-xs-3"></div>';
	echo     	'<div class="col-xs-6">';
	echo '<div style = "text-align:center">';
	echo '<h1>コース結果</h1>';
	echo '<table class="table table-bordered">';
	echo '<tr><th>'.'ユーザID'.'</th><th>'.'名前'.'</th><th>'.'コース'.'</th></tr>';
	while($row){
		$cid = $row['cid'];
		echo '<td>' .strtoupper($row['uid']). '</td>';
		echo '<td>' .$row['uname']. '</td>';
		echo '<td>' .$courses[$cid]. '</td>';
		echo '</tr>';
		$row = mysql_fetch_array($rs);
	}
	echo '</table>';
	echo'</div>';
	echo        '</div>';
	echo     	'<div class="col-xs-3"></div>';
}
include('page_footer.php');

?>