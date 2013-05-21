<?php
	#用户参加活动
        require_once(dirname(__FILE__).'/con_sql.php');

        header('Content-type: application/json');
        $obj = json_decode(file_get_contents('php://input'),true);
        $uid = (int)$obj['uid'];
        $aid = (int)$obj['aid'];
        $reason = $obj['reason'];

        $msql = new sql();
        $db = $msql->get_db();

        $s = "insert into Apply values('$aid', '$uid', 0, '$reason')";
        $res = $db->query($s);

        if ($res){
                $s = "UPDATE Activity a SET a.ajoined = a.ajoined+1 WHERE a.aid = '$aid'";
                $res = $db ->query($s);
                $arr = array("msg" => "Success");
        }
        else $arr = array("msg" => "Fail");
        
		$send = json_encode($arr);
        echo $send;
?>
