<?php
	#返回用户参加过的活动
        require_once(dirname(__FILE__).'/con_sql.php');

        header('Content-type: application/json');
        $obj = json_decode(file_get_contents('php://input'),true);
        $uid = (int)$obj['uid'];

        $msql = new sql();
        $db = $msql->get_db();

        $s = "select a.aid from Apply a where a.uid = '$uid' and a.isApprove = 1";
        $res = $db->query($s);
        $data = NULL;
        if ($res){
                $num_result = $res->num_rows;
                for ($i = 0; $i < $num_result; $i++){
                    $row = mysqli_fetch_assoc($res);
                    $aid = $row['aid'];

                    $sql = "select * from Activity a where a.aid = '$aid'";
                    $nres = $db->query($sql);
                    $act = mysqli_fetch_assoc($nres);

                    $k = "Activity".(string)$i;
                    $data[$k] = $act;
                }
        }
		
        $send = json_encode($data);
        echo $send;
?>

