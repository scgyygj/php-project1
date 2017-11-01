<?php
header('Content-type:text/html;charset=utf8');
if($_SERVER['REQUEST_METHOD']=='GET'){
    include  '../libs/db.php';
    include  '../libs/function.php';
    $obj=new unit();
    $cid=$_GET['cid'];  //通过点击获取当前栏目的id
    $lanmu=$obj->cateTree(0,$mysql,'cadegory',0,$cid);    //获取当前栏目的父栏目
    $cname=$obj->cateone($mysql,'cadegory',"{$cid}",'cname');//获取当前栏目的栏目名称
    include '../template/admin/updateCate.html';

}else{
    include '../libs/db.php';
    include '../libs/function.php';
    $cid=$_POST['cid'];
    $name=$_POST['cname'];
    $pid=$_POST['pid'];
    $sql="update  cadegory set cname='{$name}',pid={$pid} where cid={$cid}";
    $data=$mysql->query($sql);
    if($mysql->affected_rows){
        $message='修改成功';
        $url='showCategory.php';
        include  'message.html';
    }else{
        $message='删除失败';
        $url='showCategory.php';
        include  'message.html';
    }

}