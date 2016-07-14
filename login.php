<?php include('page_header.php');
?>


<h1>コース分け希望調査Webシステム</h1>

<img src="http://www.is.kyusan-u.ac.jp/gaikan.jpg">
<form action="check.php" method="post">
<table align="center">
	<tr>
		<td class="log"><font class="login">ユーザ名：</font></td>
		<td><input type="text" name="uid" class="form-control" placeholder="UserName"></td>
	</tr>
	<tr>
		<td class="log"><font class="login">パスワード：</font></td>
		<td><input type="password" name="pass" class="form-control" placeholder="PassWord"></td>
	</tr>
</table>

<button type="submit" value="送信" class="btn btn-info btn-sm">送信</button>
<button type="reset" value="取消" class="btn btn-danger btn-sm">取消</button>
</form>

<?php include('page_footer.php');
?>