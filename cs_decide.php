<?php
session_start();
include('page_header.php');  //画面出力開始
require_once('db_inc.php');
//entryを参照。GPAが2.0以上 取得単位が38単位以上
//cidが1かつGPAが2.0、単位38単位以上は総合コースに决定。
//それ以外はすべて応用コースに
//cs_listのように希望状況を表示する。
echo '<div class="container-fluid">';
echo  	  '<div class="row">';
echo     	'<div class="col-xs-3"></div>';
echo     	'<div class="col-xs-6">';
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 2) {
	// 教員としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else{

	$courses = array(
	1=>'情報技術応用コース',
	2=>'情報科学総合コース'
	);

	$sql = "SELECT uid,uname,cid,取得単位,GPA
			FROM vw_people NATURAL JOIN tb_entry NATURAL JOIN tb_user GROUP BY uid";
	$rs = mysql_query($sql, $conn);
	if (!$rs){
		die('エラー: ' . mysql_error());
	}else

	$row = mysql_fetch_array($rs);
	echo "<h1>コース決定</h1>";
	echo '<table border=1 class="table table-hover">';
	echo '<tr><th>'.'ユーザID'.'</th><th>'.'氏名'.'</th><th>'.'希望コース'.'</th><th>'.
	 '取得単位'.'</th><th>'.'GPA'.'</th></tr>';
	while($row){
		echo '<td>' . strtoupper($row['uid']).'</td>';
		echo '<td>' . $row['uname'].'</td>';
		echo '<td>' . $courses[$row['cid']].'</td>';
		echo '<td>' . $row['取得単位']. '</td>';
		echo '<td>' . $row['GPA']. '</td>';
		echo '</tr>';
		$row = mysql_fetch_array($rs) ;
	}
	echo '</table>';
	  echo '<a href="cs_decide_do.php?">実行</a> ';
}
	echo '</div>';


echo     	'<div class="col-xs-3"></div>';
include('page_footer.php');
?>