<?php
require_once 'config.php';
require_once 'templates/header.php';

if(isset($_SESSION['username'])) {
    header("Location: novels.php");
    exit();
}
?>

<h2>Login to Novel Library</h2>
<form action="login.php" method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form>

<?php require_once 'templates/footer.php'; ?>