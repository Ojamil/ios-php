<?php
	#查看某活动的详情资料
        require_once(dirname(__FILE__).'/con_sql.php');

        header('Content-type: application/json');
        $obj = json_decode(file_get_contents('php://input'),true);
        $aid = (int)$obj['aid'];

        $msql = new sql();
        $db = $msql->get_db();

        $s = "select * from Activity a where a.aid = '$aid'";
        $res = $db->query($s);

        if ($res){
                $row = mysqli_fetch_assoc($res);
                $s = "UPDATE Activity a SET a.aclick = a.aclick+1 WHERE a.aid = '$aid'";
                $res = $db ->query($s);
                $row['aclick'] = (string)($row['aclick']+1);
                $arr = array("msg" => "Success", "data"=>$row);
        }
        else $arr = array("msg" => "Fail", "data"=> NULL);
        $send = json_encode($arr);
        echo $send;
?>
