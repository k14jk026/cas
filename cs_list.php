<?php
session_start();
require_once('db_inc.php');  //データベース接続
if ( isset($_SESSION['urole']) and $_SESSION['urole']==2) {
	$uid   = $_SESSION['uid'];
	$uname = $_SESSION['uname']; // 認証済みのユーザ名
}else { // その以外は
	die('エラー：この機能を利用する権限がありません');
}
echo '<div class="container-fluid">';
echo  	  '<div class="row">';
echo     	'<div class="col-xs-3"></div>';
echo     	'<div class="col-xs-6">';

echo '<div style = "text-align:center">';
include('page_header.php');  //画面出力開始
$sql = "select * from tb_entry natural join tb_user natural join  tb_course uid ORDER BY uid";
$rs = mysql_query($sql, $conn);//SQL文をサーバーに送信し実行

if (!$rs){
	die('エラー: ' . mysql_error());
}

$row = mysql_fetch_array($rs);
echo "<h2>コース希望一覧</h2>";
echo '<table border=1 class="table table-hover">';
echo '<tr><th>'.'ユーザID'.'</th><th>'.'氏名'.'</th><th>'.'希望コース'.'</th><th>'.'アピール文'.'</th></tr>';
while($row){
	echo '<td>' .strtoupper($row['uid']) . '</td>';
	echo '<td>' . $row['uname']. '</td>';
	echo '<td>' . $row['cname'] . '</td>';
	echo '<td>' . $row['wishtext'] . '</td>';
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;
}
echo '</table>';
echo '</div>';

echo        '</div>';
echo     	'<div class="col-xs-3"></div>';
include('page_footer.php');  //画面出力終了
?>