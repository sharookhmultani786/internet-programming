<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "growcery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email =$_GET['email'];
if (empty($email)) {
    echo json_encode(["error" => "Email is required"]);
    exit;
}

$sql = "SELECT * FROM orders WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();


$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($orders);
?>
