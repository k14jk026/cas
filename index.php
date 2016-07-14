<?php
 session_start();
 include('page_header.php');    //ページヘッドを出力
 if (isset($_SESSION['uid'])){
   echo '<h2>ホーム画面</h2>';
   echo '<font>ようこそ！'. $_SESSION['uname'] . 'さん</font><br>';
   echo '<font>ユーザID：'. $_SESSION['uid'] . '</font><br>';
   echo '<font>種別(1: 学生、2:教員、9:管理者)：'. $_SESSION['urole'] . '</font>';
 //  echo '<a href="logout.php">ログアウト</a>';
 }else{
   echo '<h2>このページは、ログインしないと利用できません！</h2>';
  echo '<a href="login.php">ログインする</a>';
 }
 include('page_footer.php');    //ページフッタを出力
?>