<?php
	#用户登录，返回个人信息
	require_once(dirname(__FILE__).'/get_activity.php');
	header('Content-type: application/json');
	$obj = json_decode(file_get_contents('php://input'),true);

	$email=$obj['email'];
	$password=$obj['password'];

	$msql = new sql();
	$db = $msql->get_db();


	$act = new activity();
	$all = $act->get();
	$db = new mysqli($mysql_servername , $mysql_username , $mysql_password,$mysql_database);
	//.......name.password........
	if ($email && $password){
		$sql = "SELECT * FROM User U WHERE U.email = '$email' and U.password='$password'";  //..........
		$res = $db->query($sql);
		$rows= mysqli_fetch_assoc($res);
		if($rows){
			$msg = "Accepted";
			$inf = array("uid"=>$rows['uid'],
                        "email"=>$rows['email'],
                        "gender"=>$rows['gender'],
                        "birthdate"=>$rows['birthdate'],
                        "uname"=>$rows['uname'],
                        "city"=>$rows['city'],
                        "tel"=>$rows['tel'],
                        "mob"=>$rows['mob'],
                        "qq"=>$rows['qq'],
                        "sid"=>$rows['sid'],
                        "selfIntroduction"=>$rows['selfIntroduction'],
                        "photo"=>$rows['photo']);
			$arr = array ( "inf" => $inf,"msg" => $msg, "data"=>$all);
			$send = json_encode($arr);
			echo $send;
			exit;
		}
		else{
			$msg = "Error";
			$arr = array ( "inf" => NULL,"msg" => $msg, "data"=> NULL);
			$send = json_encode($arr);
			echo $send;
			exit;
        }
	}
	else{
        $msg = "Null";
        $arr = array ( "uid" => NULL,"msg" => $msgi, "data"=>NULL);
        $send = json_encode($arr);
        echo $send;
        exit;
	}
?>
