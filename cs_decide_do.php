<?php
session_start();
include('page_header.php');
require_once('db_inc.php');
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=2 ) {
	// 教員でなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else {
	echo '<h2>要件に従いコースを決定しました。</h2>';
	$sql = "SELECT *
			FROM tb_entry
			WHERE uid IN(
			SELECT uid FROM tb_result)"; //希望を提出していて結果が決まっている学生を取得
	$rs = mysql_query($sql, $conn);
	$sql2 ="SELECT *
			FROM tb_entry
			WHERE uid NOT IN(
			SELECT uid FROM tb_result)";//希望を提出していて結果の決まっていない学生を取得
	$rs2 = mysql_query($sql2, $conn);
	$sql3 ="SELECT uid,uname
			FROM vw_people NATURAL JOIN tb_user
			WHERE urole = 1 AND uid NOT IN(
			SELECT uid FROM tb_entry WHERE urole = 1)ORDER BY uid";//未提出者を取得
	$rs7 = mysql_query($sql3, $conn);
	if (!$rs) {
		die ('エラー: ' . mysql_error());
	}
	if (!$rs2) {
		die ('エラー: ' . mysql_error());
	}
	if (!$rs7) {
		die ('エラー: ' . mysql_error());
	}
	$row = mysql_fetch_array($rs);
	while($row){ //結果の決まっている学生に対して
		$uid = $row['uid'];
		$sql_result = //要件を満たしている学生は応用コースに更新
			"UPDATE tb_result JOIN tb_entry JOIN vw_people set tb_result.cid = tb_entry.cid
			 WHERE '$uid' = vw_people.uid AND vw_people.uid = tb_result.uid AND(2.0 <= vw_people.GPA AND 38 <= vw_people.取得単位)";
		$rs3 = mysql_query($sql_result, $conn);
		$sql_result2 = //要件を満たしていない学生は応用コースに更新
			"UPDATE tb_result JOIN tb_entry JOIN vw_people set tb_result.cid = 1
			 WHERE  '$uid' = vw_people.uid AND vw_people.uid = tb_result.uid AND(vw_people.GPA < 2.0 OR vw_people.取得単位 < 38)";
		$rs4 = mysql_query($sql_result2, $conn);
		$row = mysql_fetch_array($rs);
	}
	$row2 = mysql_fetch_array($rs2);
	while($row2){
		$uid2 = $row2['uid'];
		$sql_result3 =//結果の決まっていなくて要件を満たしていない
			"INSERT INTO tb_result
			SELECT uid,uname,1
			FROM tb_entry NATURAL JOIN vw_people
			WHERE '$uid2' = vw_people.uid AND(vw_people.GPA < 2.0 OR vw_people.取得単位 < 38)";
		$rs5 = mysql_query($sql_result3, $conn);
		$sql_result4 = //結果の決まっていなくて要件を満たしている
			"INSERT INTO tb_result
			SELECT uid,uname,tb_entry.cid
			FROM tb_entry NATURAL JOIN vw_people
			WHERE '$uid2' = vw_people.uid AND(2.0 <= vw_people.GPA AND 38 <= vw_people.取得単位)";
		$rs6 = mysql_query($sql_result4, $conn);
		$row2 = mysql_fetch_array($rs2);
	}
	$row3 = mysql_fetch_array($rs7);
	while($row3){//未提出者
		$uid3 = $row3['uid'];
		$sql_result5 = "INSERT INTO tb_result
			SELECT uid,uname,1
			FROM tb_user
			WHERE '$uid3' = tb_user.uid";
		$rs8 = mysql_query($sql_result5, $conn);
		$row3 = mysql_fetch_array($rs7);
	}
}
include('page_footer.php');
?>