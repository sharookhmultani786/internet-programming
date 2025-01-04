<?php
header("text");
$conn=mysqli_connect("localhost","root","","growcery");
if(isset($_GET['id']))
{
$id=$_GET['id'];
mysqli_query($conn,"UPDATE orders SET order_status='Cancelled' where id=$id");
echo "success";
}
if(isset($_GET['status']))
{
    $status=$_GET['status'];
    $result=mysqli_query($conn,"SELECT order_status FROM orders where id=$status");
    if($result->num_rows!= 0)
    {
        $row=$result->fetch_assoc();
        if($row['order_status']=='Active') echo 'Success';
        else echo "fail";
    }
    else echo "fail";
}
$conn->close();
?>