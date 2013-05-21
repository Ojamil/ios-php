<?php
	#用户注册，返回uid
	require_once(dirname(__FILE__).'/con_sql.php');
	header('Content-type: application/json;charset=utf-8');
	$obj = json_decode(file_get_contents('php://input'),true);

	$email=$obj['email'];
	$password=$obj['password'];
	$uname=urldecode($obj['uname']);
	$gender=$obj['gender'];
	$birthdate=$obj['birthdate'];
	$sid=$obj['sid'];
	$tel=$obj['tel'];
	$selfIntroduction=$obj['selfIntroduction'];
	//$city=$obj['city'];
	$city=1;
	$mob=$obj['mob'];
	$qq=$obj['qq'];
	$time=0;
	$photo=$obj['photo'];


	$msql = new sql();
	$db = $msql->get_db();

	$uid = 0;
	$sql = "select * from User u where u.email = '$email'";
	mysql_query("set names 'utf8'");
	$exist = $db->query($sql);
	$nul = $exist->num_rows;
	if ($nul == 0){
		$sql = "INSERT INTO User VALUES(NULL,'$email', '$password', '$uname', '$gender', '$birthdate', '$sid', '$tel', '$selfIntroduction', '$city', '$mob', '$qq', '$time', '$photo')";
		$res = $db->query($sql);
		if($res){
			$msg = "Success";
			$sql = "select u.uid, u.uname from User u where u.email = '$email'";
			$r = $db -> query($sql);
			$n = mysqli_fetch_assoc($r);
			$uid = $n['uid'];
			//$msg = $n['uname'];
			$arr = array("uid"=>$uid, "msg"=>urlencode($msg));
			$send = json_encode($arr);
			echo $send;
			exit;
        }
		else{
			$msg = "Error";
			$arr = array("uid"=>$uid, "msg" => $msg);
			$send = json_encode($arr);
			echo $send;
			exit;
		}
	}
	else{
		$msg = "Existed";
		$arr = array ("uid"=>$uid, "msg" => $msg);
		$send = json_encode($arr);
		echo $send;
		exit;
	}
?>

