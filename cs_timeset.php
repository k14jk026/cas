<?php
session_start();
date_default_timezone_set('Asia/Tokyo'); //時刻を東京に
include('page_header.php');
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=2 ) {
	// 教員でなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}else {
	echo'<h2>締切変更設定</h2>';
	echo '<font>現在の時刻：';
	echo date("Y/m/d/H:i:s")."\n";
	echo '</font>';
	//echo '<font class="time">"'.date("Y/m/d/H:i:s")'."\n".</font>';
	echo '</br>'."\n";
	echo '<form action="cs_timeset_do.php" method="post" >'."\n";

	echo '<select name="year">'."\n";
	for($i=2010; $i<=2018; $i++){
		if(date("Y") == $i){
			echo '<option value='.$i.' selected>'.$i.'</option>'."\n";
		}else{
			echo '<option value='.$i.'>'.$i.'</option>'."\n";
		}
	}
	echo '</select>'."\n";

	echo '<select name="month">'."\n";
	for($j=1; $j<=12; $j++){
		if(date("m") == $j){
			echo '<option value='.$j.' selected>'.$j.'月</option>."\n"';
		}else{
			echo '<option value='.$j.'>'.$j.'月</option>."\n"';
		}
	}
	echo '</select>'."\n";

	echo '<select name="day">'."\n";
	for($k=1; $k<=31; $k++){
		if(date("d") == $k){
			echo '<option value='.$k.' selected>'.$k.'日</option>'."\n";
		}else{
			echo '<option value='.$k.'>'.$k.'日</option>'."\n";
		}
	}
	echo '</select>'."\n";

	echo '<select name="hour">'."\n";
	for($l=0; $l<=23; $l++){
		if(date("H") == $l){
			echo '<option value='.$l.' selected>'.$l.'時</option>'."\n";
		}else{
			echo '<option value='.$l.'>'.$l.'時</option>."\n"';
		}
	}
	echo '</select>'."\n";

	echo '<select name="minute">'."\n";
	for($n=0; $n<=59; $n++){
		if(date("i") == $n){
			echo '<option value='.$n.' selected>'.$n.'分</option>."\n"';
		}else{
			echo '<option value='.$n.'>'.$n.'分</option>."\n"';
		}
	}
	echo '</select>'."\n";

	echo '<select name="sec">'."\n";
	for($m=0; $m<=59; $m++){
		if(date("s") == $m){
			echo '<option value='.$m.' selected>'.$m.'秒</option>."\n"';
		}else{
			echo '<option value='.$m.'>'.$m.'秒</option>."\n"';
		}
	}
	echo '</select>'."\n";
	echo '<br><br><button type="submit" value="送信" class="btn btn-info btn-sm">送信</button>'."\n";
	echo '<button type="reset" value="取消" class="btn btn-danger btn-sm">取消</button>'."\n";
	echo '</form>'."\n";
}

?>