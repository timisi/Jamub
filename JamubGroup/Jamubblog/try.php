<?php
$host ="localhost";
$user = "root";
$password="";
$db = "jamubblog"; 

mysql_connect($host,$user,$password);
$mysql_select_db($db);
if(isset($_POST['username'])){
    $uname=$_POST['username'];
    $password=$_POST['password'];
    $sql="select * from user where user='".$uname."'AND Pass='".$password."''
    limit 1";
    $result=mysqli_query($sql);
    
    if(mysql_num_rows($result)==1){
        echo "You have successfully Logged in";
        exit();

    }
    else{
        echo "You have Entered Incorrect Password";
        exit();
    }
}


?>