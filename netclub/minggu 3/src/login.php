<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $conn = get_db_connection();
    
    // VULNERABLE: SQL Injection melalui concatenation
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: novels.php");
        exit();
    } else {
        require_once 'templates/header.php';
        echo "<div class='error'>Login failed! Invalid credentials.</div>";
        echo "<a href='index.php'>Try again</a>";
        require_once 'templates/footer.php';
    }
    
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>