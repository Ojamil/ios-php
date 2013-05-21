<?php
	#返回用户的公益时数
        require_once(dirname(__FILE__).'/con_sql.php');

        header('Content-type: application/json');
        $obj = json_decode(file_get_contents('php://input'),true);
        $uid = (int)$obj['uid'];

        $msql = new sql();
        $db = $msql->get_db();

        $s = "select u.time from User u where u.uid = '$uid'";
        $res = $db->query($s);

        if ($res){
                $row = mysqli_fetch_assoc($res);
                $arr = array("msg" => "Success", "time"=>$row['time']);
        }
        else $arr = array("msg" => "Fail", "time"=> NULL);

        $send = json_encode($arr);
        echo $send;
?>
