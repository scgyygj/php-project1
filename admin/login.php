<?php
header('Content-type:text/html;charset=utf8');
//判断获取方式如果是get类型，就跳到login.html
if($_SERVER['REQUEST_METHOD']=='GET'){
    //显示页面
    include '../template/admin/login.html';
}else{
    //验证
    //前台数据
//    var_dump($_REQUEST);  //查看前台数据
    $user=$_POST['user'];
    $pass=$_POST['pass'];

    //连接数据库，获取后台数据
    header('Content-type:text/html;charset=utf8');
    $mysql=new mysqli('localhost','root','','love','3306');
    $mysql->query('set names utf8');  //设置查询字符集
    if($mysql->connect_errno){
        echo '数据库连接失败,失败信息'.$mysql->connect_errno;
        exit;
    }
    $sql="select * from  admin where uname='{$user}'";        //在数据库里查询表
    $result=$mysql->query($sql);         //查询 结果集
    $data=$result->fetch_all(MYSQLI_ASSOC);   //把查询到的东西变成关联数组  二维数组
    foreach ($data as $index=>$value){            //遍历数组
        if( $value['upass']==$pass ){
            header('location:main.php');
        }
    }
            $message='登录失败';
            $url='login.php';
            include 'message.html';
}
