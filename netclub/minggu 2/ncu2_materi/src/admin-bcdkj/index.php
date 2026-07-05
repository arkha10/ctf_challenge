<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'] ?? '';
    $output = shell_exec("ping -c 2 " . $host);
    echo "<pre>$output</pre>";
    exit;
}

if (isset($_COOKIE['admin']) && $_COOKIE['admin'] === 'true') {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Panel</title>
        <script>
            function validateInput(e) {
                const forbidden = [";", "&&", "||", "|" , "&"];
                let value = e.target.value;
                for (let f of forbidden) {
                    if (value.includes(f)) {
                        alert("Karakter terlarang terdeteksi!");
                        e.target.value = value.replace(f, "");
                    }
                }
            }
        </script>
    </head>
    <body>
        <h2>Ping Tool</h2>
        <form method="POST">
            <span>masukkan IP, contoh: 127.0.0.1</span><br>
            <input type="text" name="host" oninput="validateInput(event)">
            <br><br>
            <button type="submit">Ping</button>
        </form>
    </body>
    </html>
    <?php
    exit;
}

setcookie('admin', 'false', time() + 3600, '/');
echo "anda belum bisa mengakses fitur admin (wleee)";
exit;
?>
