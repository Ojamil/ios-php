<?php
	#返回含活动的data关联数组
	require_once(dirname(__FILE__).'/con_sql.php');
	class activity
	{
	public function get(){
				$obj = new sql();
                $db = $obj->get_db();
                $sql = "select * from Activity";
                $res = $db->query($sql);
                if ($res){
                        $num_result = $res->num_rows;
                        for ($i = 0; $i < $num_result; $i++){
                                $k = "Record".(string)$i;
                                //echo $k;
                                $row = $res->fetch_assoc();
                                $data[$k] = $row;
                        }
                        return $data;
                }
        }
	};
?>
