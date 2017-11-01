<?php
//参数
//$pid  父级id
//$mysql  连接数据库   $db 资源
//$table    表
//$flag    层级    几级栏目（从顶层栏目开始找，父id为0）

 class unit{
    function __construct()   //构造函数，用来定义属性。
    {
        $this->str = '';     //定义属性
        $this->parentid=null;
    }
   function cateTree($pid,$db,$table,$flag,$current=null){
       $flag++;
       //查找父id
      if($current){
          $sql="select pid from {$table} where cid={$current} ";
          $data=$db->query($sql)->fetch_assoc();
          $this->parentid=$data['pid'];
      }
        $sql="select * from {$table} where pid={$pid}";
        $data=$db->query($sql);
        while($row=$data->fetch_assoc()){   //	从结果集中取得一行作为关联数组,一维数组。
//            字符串拼接，最终输出在页面中。
            if($row['cid']==$this->parentid){
                $this->str.="<option value={$row['cid']} selected> $flag{$row['cname']}</option>";
            }
            $this->str.="<option value={$row['cid']}> $flag{$row['cname']}</option>";
            $this->cateTree($row['cid'],$db,$table,$flag);  //找当前栏目的子栏目，当前栏目的id做为父id.
        }
        return $this->str;
   }

   //查看
  function cateTale($db,$table){
       $sql="select * from $table";
       $data=$db->query($sql)->fetch_all(MYSQLI_ASSOC);
       foreach ($data as $index=>$value){
           $this->str.="<tr>
            <td>{$value['cid']}</td>             
            <td>{$value['cname']}</td>
            <td>{$value['pid']}</td>
            <td><a href=\"deleteCategoty.php?cid={$value['cid']}\">删除</a>
            <a href=\"updateCate.php?cid={$value['cid']}\">修改</a></td>
            </tr>
            ";
       }
      return $this->str;
  }

  function cateone($db,$table,$id,$attr){
      $sql="select $attr from $table where cid=$id";
      $data=$db->query($sql)->fetch_assoc();
      $cname=$data[$attr];
      return $cname;

  }
}
