<?php
header('Content-type:text/html;charset=utf8');
if($_SERVER['REQUEST_METHOD']=='GET'){

    //连接数据库
    include '../libs/db.php';
    include '../libs/function.php';
    $cate=new unit();
    $option=$cate->cateTree(0,$mysql,'cadegory',0);
    include '../template/admin/addCategory.html';
}else{
    include '../libs/db.php';
    $cname=$_POST['cname'];  //前台数据
    $pid=$_POST['pid'];
    $sql="insert into cadegory (pid,cname ) value ('{$pid}','{$cname}')";
    $mysql->query($sql);       //发送一条查询
    if($mysql->affected_rows){         //	取得前一次 MySQL 操作所影响的记录行数。
        echo '<script>alert(succes)</script>';
        $message='栏目插入成功';
        $url='showCategory.php';
    }
    else{
        $message='栏目插入失败';
        $url='addCategory.php';
    }
      include 'message.html';
}
?>