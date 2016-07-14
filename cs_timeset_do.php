<?php
session_start();
include('page_header.php');
require_once('db_inc.php');

$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
$hour = $_POST['hour'];
$minute = $_POST['minute'];
$sec = $_POST['sec'];
/*
 echo $year;
 echo $month;
 echo $day;
 echo $hour;
 echo $minute;
 echo $sec;
 */
$sql = "SELECT EXISTS(SELECT * FROM tb_timelimit) AS result";//テーブルの中にデータが存在しているかどうかを確認するためのsql
$rs = mysql_query($sql, $conn);
if (!$rs) {
	die ('エラー: ' . mysql_error());
}
$row = mysql_fetch_array($rs) ;
if($row['result'] == 0){
	$sql_insert = "INSERT INTO tb_timelimit(timelimit) VALUES('{$year}-{$month}-{$day} {$hour}:{$minute}:{$sec}')";
	$rs_insert = mysql_query($sql_insert, $conn);
	if (!$rs_insert) {
		die ('エラー: ' . mysql_error());
	}
		echo "<h1>締切時間を".$year.'-'.sprintf('%02d',$month).'-'.sprintf('%02d',$day)." ".$hour.':'.sprintf('%02d',$minute).':'.$sec."に設定しました</h1>";
}else{
	$sql_update =
	"UPDATE tb_timelimit set timelimit ='{$year}-{$month}-{$day} {$hour}:{$minute}:{$sec}'"; //締め切り時間をUPDATEする
	$rs_update = mysql_query($sql_update, $conn);
	if (!$rs_update) {
		die ('エラー: ' . mysql_error());
	}
	//echo "<h1>締切時間を{$year}-{$month}-{$day} {$hour}:{$minute}:{$sec}に変更しました</h1>";
	echo "<h1>締切時間を".$year.'-'.sprintf('%02d',$month).'-'.sprintf('%02d',$day)." ".$hour.':'.sprintf('%02d',$minute).':'.$sec."に変更しました</h1>";
}
?>