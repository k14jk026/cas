<?php
 session_start();
 unset($_SESSION);
 session_destroy();
 include('page_header.php');    //ページヘッドを出力
 echo "<h3>ログアウトしました！</h3>";
 echo '<a href="index.php">トップページ</a>';
 include('page_footer.php');    //ページフッタを出力
?>