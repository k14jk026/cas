<?php
require_once ('db_inc.php');  // データベース接続
session_start();
include('page_header.php');

if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=1 ) {
	// 学生としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else {
	$courses = array(
	1=>'情報技術応用コース',
	2=>'情報科学総合コース');
	$uid = $_SESSION['uid']; //ログイン中のユーザのuidを$uidに代入
	$sql = "SELECT * FROM tb_result WHERE uid  = '{$uid}'";
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs) ;
	$cid = $row['cid'];
	echo '<div class="container-fluid">';
	echo  	  '<div class="row">';
	echo     	'<div class="col-xs-3"></div>';
	echo     	'<div class="col-xs-6">';
	echo '<div style = "text-align:center">';
	echo '<h1>コース結果</h1>';
	echo '<table class="table table-bordered">';
	echo '<tr><th>'.'ユーザID'.'</th><th>'.'名前'.'</th><th>'.'コース'.'</th></tr>';
	echo '<td>' .strtoupper($uid). '</td>';
	echo '<td>' .$row['uname']. '</td>';
	if($row['cid']){
		echo '<td>' .$courses[$cid]. '</td>';
	}else{
		echo '<td>---</td>';
	}
	echo '</table>';
	echo'</div>';
	echo        '</div>';
	echo     	'<div class="col-xs-3"></div>';
}
include('page_footer.php');

?>