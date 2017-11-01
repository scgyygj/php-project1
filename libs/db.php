<?php
header('Content-type:text/html;charset=utf8');
$mysql=new mysqli('localhost','root','','love','3306');
$mysql->query('set names utf8');  //设置查询字符集
if($mysql->connect_errno){
    echo '数据库连接失败,失败信息'.$mysql->connect_errno;
    exit;
}
?>