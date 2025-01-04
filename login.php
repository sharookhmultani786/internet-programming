<?php
session_start();
$conn=new mysqli("localhost","root","","growcery");
if(!$conn) echo 'Connection Error';

$email=$_POST['email'];
$pass=$_POST['password'];

$res=$conn->query("SELECT * FROM users where email='$email'");
if($res->num_rows>0)
{
    $row=$res->fetch_row();
    $id=$row[1];
    $auth=$row[2];
    if($id===$email && $auth===$pass)
    {     
           $_SESSION['user_name'] = $row[0];
           $_SESSION['user_email'] = $id;
          header("Location: homepage.php");
          exit();
    }
    else
    {
          echo "<script> alert('Invalid Username or Password'); window.history.back();</script>";
}}
else
{
       echo "<script> alert('No User Found!!');                    window.history.back();</script>;";
}
$conn->close();
?>