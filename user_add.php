<?php
session_start();
include('page_header.php');
require_once('db_inc.php');
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!= 9) {
	// 管理者としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else{
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-4"></div>
		<div class="col-xs-4">

	<h2>アカウント登録</h2>
	<form action="user_add_do.php" method="post">
	<table>
	<tr><th class="uad">ユーザID：</th>
	<td><input type="text" name="uid" class="form-control" placeholder="ユーザIDの入力"></td></tr>
	<tr><th class="uad">名前：</th>
	<td><input type="text" name="uname" class="form-control" placeholder="ユーザ名の入力" /></td></tr>
	<tr><th class="uad">パスワード:</th>
	<td><input type="password" name="upass" class="form-control" placeholder="パスワードの入力"/></td></tr>
	<tr><th class="uad">権限:</th>
	<td class="log"><select name="urole">
  	<option value="1" selected> 学生</option>
  	<option value="2"> 教員</option>
  	<option value="9"> 管理者</option>
</select>
	</td></tr>
	</table>
		<a href="user_add_do.php?">
		<input class="btn btn-default btn-sm" type="submit" value="送信"></a>
		</form>

		</div>
		<div class="col-xs-4"></div>
	</div>
</div>

	<?php
}
include('page_footer.php');
?>