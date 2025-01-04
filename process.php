<?php
$servername = "localhost";
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$dbname = "growcery"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $email = $data['email'];
    $paymentMethod = $data['paymentMethod'];
    $paymentDetails = json_encode($data['paymentDetails']);
    $billingInfo = json_encode($data['billingInfo']);
    $shippingInfo = json_encode($data['shippingInfo']);
    $cartProducts = json_encode($data['cartProducts']);
    $ostatus="Active";
    $stmt=$conn->prepare("INSERT INTO orders (email,payment_method,payment_details,billing_info,shipping_info,cart_products,order_status) values(?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss",$email,$paymentMethod,$paymentDetails,$billingInfo,$shippingInfo,$cartProducts,$ostatus);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Order processed successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to process order."]);
    }
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No data received."]);
}
$conn->close();
?>