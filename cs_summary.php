<?php
session_start();
include('page_header.php');  //画面出力開始
require_once('db_inc.php');
if ( isset($_SESSION['urole']) and $_SESSION['urole']==2 ) {
	$uid   = $_SESSION['uid'];
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
}else { // その以外は
	die('エラー：この機能を利用する権限がありません');
}
echo '<h2>コース希望集計一覧</h2>';
echo '<div class="container-fluid">';
echo  	  '<div class="row">';
echo     	'<div class="col-xs-3"></div>';
echo     	'<div class="col-xs-6">';

echo '<div style = "text-align:center">';
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 2) {
	// 教員としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else{

	$courses = array(
	1=>'情報技術応用コース',
	2=>'情報科学総合コース'
	);

	$sql_1 ="SELECT COUNT(cid) AS 応用コース
		FROM tb_entry
		WHERE cid = 1";//応用コースの数を求めるsql
	$rs = mysql_query($sql_1, $conn);
	$sql_2 = "SELECT COUNT(cid) AS 総合コース
		FROM tb_entry
		WHERE cid = 2";//総合コースの数を求めるsql
	$rs2 = mysql_query($sql_2, $conn);
	if (!$rs){
		die('エラー: ' . mysql_error());
	}else
	if (!$rs2){
		die('エラー: ' . mysql_error());
	}else

	$row = mysql_fetch_array($rs);
	$row2 = mysql_fetch_array($rs2);
	echo '<table class="table table-hover table table-bordered">';
	echo '<tr><th>コース名</th><th>希望人数</th></tr>';
	echo '<td>'.$courses[1].'</td>';
	echo '<td>'.$row['応用コース'].'</td>';
	echo '<tr><td>'.$courses[2].'</td>';
	echo '<td>'.$row2['総合コース'].'</td></tr>';
	echo '</div>';

echo        '</div>';
echo     	'<div class="col-xs-3"></div>';
	include('page_footer.php');
}
?>