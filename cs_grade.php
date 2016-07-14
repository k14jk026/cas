<?php
require_once('db_inc.php');
session_start();
include('page_header.php');//画面出力開始
//上のsql2はVIEW化する。
echo '<div class="container-fluid">';
echo  	  '<div class="row">';
echo     	'<div class="col-xs-3"></div>';
echo     	'<div class="col-xs-6">';

echo '<div style = "text-align:center">';
if ( isset($_SESSION['urole']) and $_SESSION['urole']==1 ) {
	//学生としてログインしているなら
	$uid   = $_SESSION['uid'];
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
}else { // その以外は
	die('エラー：この機能を利用する権限がありません');
}
echo '<h2>成績確認</h2>';
$sql = "SELECT * FROM vw_people WHERE uid  = '{$uid}'";

$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;

echo '<table class="table table-bordered">';
echo '<tr><th>ユーザID</th><th>名前</th><th>取得単位数</th><th>GPA</th></tr>';
echo '<tr><td>' .strtoupper($uid). '</td>';
echo '<td>' .$uname. '</td>';
echo '<td>' .$row['取得単位']. '</td>';
echo '<td>' .$row['GPA']. '</td></tr>';

echo '</table>';
echo '</div>';

echo        '</div>';
echo     	'<div class="col-xs-3"></div>';
include('page_footer.php');
?>