<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novel Library - CTF Lab</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .nav { background: #f4f4f4; padding: 10px; margin-bottom: 20px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <h1>📚 Novel Library</h1>
            <?php if(isset($_SESSION['username'])): ?>
                <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> | 
                <a href="novels.php">Novels</a> | 
            <?php else: ?>
                <a href="index.php">Login</a>
            <?php endif; ?>
        </div>