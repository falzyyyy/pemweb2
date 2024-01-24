<?php
session_start();
require_once('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $hashed_password = hash('sha256', $password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashed_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "Login gagal. Silakan cek kembali username dan password Anda.";
    }
}

$conn->close();
?>
