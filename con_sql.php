<?php
#数据库连接
class sql
{
public function get_db(){
        $db = new mysqli("localhost", "root", "youarefool",'GongYi');
        return $db;
}
};
?>
