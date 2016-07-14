<?php
session_start();
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 9) {
	// 管理者としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else{
echo '<div class="container-fluid">';
echo  	  '<div class="row">';
echo     	'<div class="col-xs-4"></div>';
echo     	'<div class="col-xs-4">';


echo "<h2>ユーザアカウント一覧</h2>";

echo '<form action="user_list.php" method="post">';
$users = array(1=>'学生',2=>'教員',9=>'管理者');
foreach ($users as $id=>$name){
	echo '<input  type="radio" name="urole" value="' . $id . '">' . '<font>'.$name.'</font>';
}
echo '<br>';

echo '<input class="btn btn-default btn-sm" type="submit" value="検索">';
echo '<input  class="btn btn-default btn-sm"type="reset" value="取消">';
echo '</form>';

//1. 選択されたユーザ種別（押されたラジオボタン）を受け取る（$_POSTから）
if(isset($_POST['urole'])){
	$urole = $_POST['urole'];
	//2. $uroleを使ってSQL文のWHERE句を作成
	$where ="WHERE urole ={$urole}";
}else{
	$where = 'WHERE 1'; // 条件なしSQLのWHERE部分を作る
}
$sql = "SELECT * FROM tb_user " . $where;//検索条件を適用したSQL文を作成
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());

$row = mysql_fetch_array($rs) ;
echo '<table class="table table-hover table table-bordered">';
echo '<tr><th>ユーザID</th><th>氏名</th><th>種別</th><th>操作</th><th></th></tr>';
while ($row) {
	echo '<tr>';
	echo '<td>' . $row['uid'] . '</td>';
	echo '<td>' . $row['uname']. '</td>';
	//echo '<td>' . $row['urole'] . '</td>';
	$roles = array( 1=>'学生', 2=>'教員', 9=>'管理者');
	$r= $row['urole'];        // 種別のコード（数字）を$rに代入
	$urole = $roles [ $r ];   // 種別の名前（配列要素）を$uroleに代入
	echo '<td>' . $urole . '</td>';
	echo '<td><a href="user_delete.php?uid='.$row['uid'] .'">削除</a></td>';
	echo '<td><a href="user_password.php?uid='.$row['uid'] .'">変更</a></td>';
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;
}
echo '</table>';


echo        '</div>';
echo     	'<div class="col-xs-4"></div>';
}
include('page_footer.php');  //画面出力終了
?>