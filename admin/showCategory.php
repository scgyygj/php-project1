<?php
header('Content-type:text/html;charset=utf8');
if($_SERVER['REQUEST_METHOD']=='GET'){
    include '../libs/db.php';
    include '../libs/function.php';
    $obj=new unit();
    $option=$obj->cateTale($mysql,'cadegory');
    include  '../template/admin/showCategory.html';
}
?>