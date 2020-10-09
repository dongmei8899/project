<?php
    header("Content-type:text/html;charset=utf-8");

    $responseData=array("code"=>0,"msg"=>"");

    $username=$_POST['username'];
    $password=$_POST['password'];

    if(!$username){
        $responseData['code']=1;
        $responseData['msg']="用户名不能为空";
        echo ($responseData['msg']);
        exit;
    }

    if(!$password){
        $responseData['code']=2;
        $responseData['msg']="密码不能为空";
        echo ($responseData['msg']);
        exit;
    }

    $link=mysql_connect("localhost","root","123456");

    if(!$link){
        $responseData['code']=4;
        $responseData['msg']="服务器忙";
        echo ($responseData['msg']);
        exit;
    }

    mysql_set_charset("utf8");
    mysql_select_db("qd2004");

    $password = md5(md5(md5($password).'qingdao')."qianfeng");

    $sql="select * from users where username='{$username}' and password='{$password}'";
    // echo json_encode($sql);
    $res=mysql_query($sql);
    $row=mysql_fetch_assoc($res);
    // echo json_encode($row);

    if($row){
        $responseData['msg'] = "登陆成功";
        echo ($responseData['msg']);
      }else{
        $responseData['code'] = 5;
        $responseData['msg'] = "用户名或密码错误";
        echo ($responseData['msg']);
        exit;
      }
      mysql_close($link);
    
?>