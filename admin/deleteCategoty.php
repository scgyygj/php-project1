<?php
header('Content-type:text/html;charset=utf8');
include '../libs/db.php';
include '../libs/function.php';
$cid=$_GET['cid'];
$sql="select * from cadegory where pid={$cid}";
$data=$mysql->query($sql);
var_dump($data->fetch_assoc());
if($data->fetch_assoc()){
    $message='存在子栏目，不允许删除';
    $url='showCategory.php';
    include  'message.html';
}else{
    $sql="delete from cadegory where cid={$cid}";
    $data=$mysql->query($sql);
    if($mysql->affected_rows){
        $message='删除成功';
        $url='showCategory.php';
        include  'message.html';
    }else{
        $message='删除失败';
        $url='showCategory.php';
        include  'message.html';
    }
}



