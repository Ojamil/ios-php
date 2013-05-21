<?php
	#返回全部活动到前端
        require_once(dirname(__FILE__).'/get_activity.php');
        header('Content-type: application/json');
        //$obj = json_decode(file_get_contents('php://input'),true);

        $obj = new activity();
        $send = json_encode($obj->get());
        echo $send;
?>
