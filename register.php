<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli('localhost', 'root', '', 'growcery');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$mobile = $_POST['mobile'];
$dob = $_POST['dob'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists!');</script>";
    echo "<script>window.history.back();</script>";
    exit;
}
$imagePath='uploads/default.jpg';
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $imageTmpPath = $_FILES['profile_image']['tmp_name'];
    $imageName = $_FILES['profile_image']['name'];
    $imageType = $_FILES['profile_image']['type'];

    $uploadsDir = 'uploads/';
    $imagePath = $uploadsDir . uniqid() . '_' . basename($imageName);
    if (!move_uploaded_file($imageTmpPath, $imagePath)) {
        die("Failed to upload image.");
    }
} else {
    echo "No image uploaded or error in upload process. Error code: " . $_FILES['profile_image']['error'];
    exit;
}
$sql = "INSERT INTO users (name, email, password, dob, mobile, profile_image) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $username, $email, $password, $dob, $mobile, $imagePath);

if ($stmt->execute()) {
    header("Location: login.html?message=Signup successful, please login");
    exit;
} else {
    header("Location: signup.html?error=An error occurred during registration");
    exit;
}

$conn->close();
?>
