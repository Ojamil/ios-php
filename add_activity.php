<?php
	#添加活动，返回aid
	require_once(dirname(__FILE__).'/con_sql.php');
	header('Content-type: application/json');
	$obj = json_decode(file_get_contents('php://input'),true);

	$aname = urldecode($obj['aname']);
	$acondition = urldecode($obj['acondition']);
	$timeBegin = $obj['timeBegin'];
	$timeEnd = $obj['timeEnd'];
	$address = urldecode($obj['address']);
	$cid = (int)$obj['cid'];
	$maxNum = (int)$obj['maxNum'];
	$applyDeadline = $obj['applyDeadline'];
	$aabs = urldecode($obj['aabs']);
	$aintro = urldecode($obj['aintro']);
	$ajoined = 0;
	$aclick = 0;
	$apublic = $obj['apublic'];
	$aphoto = $obj['aphoto'];
	$cityid = (int)$obj['cityid'];


    $msql = new sql();
    $db = $msql->get_db();

    $aid = 0;
    $sql = "select * from Activity a where a.aname = '$aname'";
    $exist = $db->query($sql);
    if ($exist){
		$sql = "INSERT INTO Activity VALUES(NULL,'$aname', '$acondition', '$timeBegin', '$timeEnd',
               '$address', '$cid', '$maxNum', '$applyDeadline', '$aabs', '$aintro',
               '$ajoined', '$aclick', '$apublic', '$aphoto','$cityid')";
		$res = $db->query($sql);

        if($res){
            $msg = "Success";
            $sql = "select a.aid from Activity a where a.aname = '$aname'";
            $r = $db -> query($sql);
			$n = mysqli_fetch_assoc($r);
            $aid = $n['aid'];
            $arr = array("aid"=>$aid, "msg"=>$msg);
            $send = json_encode($arr);
            echo $send;
            exit;
        }
        else{
            $msg = "Error";
            $arr = array("aid"=>$aid, "msg" => $msg);
            $send = json_encode($arr);
            echo $send;
            exit;
        }
    }
    else{
        $msg = "Existed";
        $arr = array ("aid"=>$aid, "msg" => $msg);
        $send = json_encode($arr);
        echo $send;
        exit;
    }	
?>