<?php
require_once ('db_inc.php');
$sql_time = "SELECT timelimit FROM tb_timelimit";
$rs_time = mysql_query($sql_time, $conn);
$row_time = mysql_fetch_array($rs_time) ;
$timelimit = $row_time['timelimit'];


$menu0 = array(  //共通メニュー:未ログイン
 'ログイン'  => 'login.php',
);
$menu1 = array(  //学生メニュー
 '成績確認'  => 'cs_grade.php'  ,
 '希望提出'  => 'cs_wish.php' ,
 '結果確認'  => 'cs_result.php' ,
);

$menu2 = array(  //教員メニュー
 '希望一覧'  => 'cs_list.php' ,
 '未提出者'  => 'cs_noentry.php' ,
 '希望集計'  => 'cs_summary.php' ,
 'コース決定'=> 'cs_decide.php',
 'コース決定結果'=> 'cs_result_all.php',
 '締め切り変更' => 'cs_timeset.php',
);
$menu3 = array(  //管理者メニュー
 'アカウント登録'  => 'user_add.php' ,
 'アカウント一覧'  => 'user_list.php' ,
 'アカウント削除'  => 'user_list.php' ,
 'パスワード変更'  => 'user_list.php'
);
$menu4 = array(  //共通メニュー:ログイン中
 'ホーム'  => 'index.php',
 'ログアウト'  => 'logout.php',

);
echo '<div style = "text-align:center">';
// ここはセッションがすでに開始したと仮定する。
if (isset($_SESSION['urole'])){//ログイン中の場合
	$urole = $_SESSION['urole']; //ユーザ種別を調べる
	//これから$uroleの値を調べ、値に応じて異なるメニューを出力
	if($urole==1){
		foreach($menu1 as $label=>$url){
			echo "<a href={$url}>{$label}  </a>";
		}
	}
	if($urole==2){
		foreach($menu2 as $label=>$url){
			echo "<a href={$url}>{$label}  </a>";
		}
	}
	if($urole==9){
		foreach($menu3 as $label=>$url){
			echo "<a href={$url}>{$label}  </a>";
		}
	}
	foreach($menu4 as $label=>$url){
		echo "<a href={$url}>{$label}  </a>";
	}
	//}else{//未ログインの場合
	//foreach($menu0 as $label=>$url){
	//			echo "<a href={$url}>{$label}  </a>";
	//		}
	if($urole != 9){
		if($timelimit){
			echo '<br><br><font>締切時間は<font class ="danger">'.$timelimit.'</font>です</font>';
		}

	}
}
echo '</div>';
?>