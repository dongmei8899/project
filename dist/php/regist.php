<?php
    header("Content-type:text/html;charset=utf-8");
    //模拟官方的返回，生成对应的内容
    $responseData = array("code" => 0,"msg" => "");
    //将输入数据取出
    $username = $_POST["username"];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    //判断取出的各个数据
    if(!$username){
        $responseData['code'] = 1;
        $responseData['msg'] = '用户名不能为空';
        echo ($responseData['msg']);
        exit;
    }
    if(!$password){
        $responseData['code'] = 2;
        $responseData['msg'] = '密码不能为空';
        echo ($responseData['msg']);
        exit;
    }
    if($repassword !== $password){
        $responseData['code'] = 3;
        $responseData['msg'] = '密码不一致';
        echo ($responseData['msg']);
        exit;
    }

    //验证数据库中是否有同名的用户
    //连接数据库
    $link = mysql_connect("localhost","root","123456");
    //判断是否连接成功
    if(!$link){
        $responseData['code'] = 4;
        $responseData['msg'] = '服务器忙';
        echo ($responseData['msg']);
        exit;
    }
    //设置字符集
    mysql_set_charset("utf8");
    //选择数据库
    mysql_select_db("qd2004");
    //准备sql语句
    $sql = "select * from users where username='{$username}'";
    // echo $sql;
    //发送sql语句
    $res = mysql_query($sql);
    //从数据库中取出数据（一行）
    $row = mysql_fetch_assoc($res);
    if($row){
        $responseData['code'] = 5;
        $responseData['msg'] = '该用户名已存在';
        echo ($responseData['msg']);
        exit;
    }
    $password = md5(md5(md5($password).'qingdao')."qianfeng");

    //注册
    $sql2 = "insert into users(username,password) values('{$username}','{$password}')";
    // echo json_encode($sql2) ;
    $res = mysql_query($sql2);
    if(!$res){
        $responseData['code'] = 6;
        $responseData['msg'] = '注册失败';
        echo ($responseData['msg']);
        exit;
    }


    $responseData['msg'] = "注册成功";
    echo ($responseData['msg']);

    // if($res){
	// 	echo "<script type='text/javascript'>alert('恭喜您，注册成功');window.history.back();</script>";
	// }else{
	// 	echo "<script type='text/javascript'>alert('啊偶，注册失败了');window.history.back();</script>";
	// }

    //关闭数据库
    mysql_close($link);
    
?>
