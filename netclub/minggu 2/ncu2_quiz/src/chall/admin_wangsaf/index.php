<?php
if (isset($_COOKIE['admin'])) {
        setcookie('admin', '', time() - 3600, '/');
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_COOKIE['role']) && $_COOKIE['role'] === 'admin') {
    $host = $_POST['host'] ?? '';
    $output = shell_exec("ping -c 2 " . $host);
    ?>
    <!doctype html>
    <html lang="id">
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width,initial-scale=1" />
      <title>Admin Ping - Result</title>
      <style>
        :root{
          --bg:#0f1724;--card:#0b1220;--muted:#94a3b8;--accent:#7c3aed;--accent-2:#06b6d4;--glass: rgba(255,255,255,0.04);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        html,body{height:100%;font-family:Inter,system-ui,Segoe UI,Roboto,Helvetica,Arial;color:#e6eef8;background:
          radial-gradient(1200px 600px at 10% 10%, rgba(124,58,237,0.12), transparent 6%),
          radial-gradient(900px 400px at 90% 90%, rgba(6,182,212,0.08), transparent 8%),
          var(--bg);
          -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;
        }
        .wrap{display:grid;grid-template-columns:320px 1fr;gap:28px;max-width:1100px;margin:48px auto;padding:28px;}
        @media (max-width:900px){ .wrap{grid-template-columns:1fr; padding:18px} .sidebar{order:2} .main{order:1} }
        .sidebar{background:linear-gradient(180deg,var(--card), rgba(11,18,32,0.88));border-radius:14px;padding:20px;box-shadow:0 10px 30px rgba(2,6,23,0.6);min-height:420px;position:relative;overflow:hidden}
        .brand{display:flex;gap:12px;align-items:center;margin-bottom:18px}
        .logo{width:46px;height:46px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;font-weight:700;color:white}
        .brand h1{font-size:18px;color:#fff}
        .brand p{font-size:12px;color:var(--muted);margin-top:2px}
        .main{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));padding:28px;border-radius:14px;box-shadow:0 10px 30px rgba(3,6,23,0.6);min-height:420px;display:flex;flex-direction:column}
        .panel{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));padding:18px;border-radius:12px;border:1px solid rgba(255,255,255,0.03)}
        pre { background: rgba(255,255,255,0.02); padding:12px; border-radius:8px; color:#dff3ff; overflow:auto; }
        .btn { background:linear-gradient(90deg,var(--accent),var(--accent-2)); color:white; padding:10px 14px; border:none; border-radius:8px; cursor:pointer; font-weight:700 }
        a.hint { color:var(--accent); text-decoration:none; font-weight:600 }
      </style>
    </head>
    <body>
      <div class="wrap">
        <div class="sidebar">
          <div class="brand">
            <div class="logo">NCU</div>
            <div>
              <h1>Get Chall</h1>
              <p>Admin Tools • Ping</p>
            </div>
          </div>
        </div>

        <div class="main">
          <div class="panel">
            <h2 style="margin-bottom:10px">Hasil Ping</h2>
            <p style="color:var(--muted);margin-top:12px">Output:</p>
            <pre><?php echo htmlspecialchars($output ?? 'No output', ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); ?></pre>

            <div style="margin-top:18px">
              <a class="btn" href="">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </body>
    </html>
    <?php
    exit;
}

if (isset($_COOKIE['role']) && $_COOKIE['role'] === 'admin') {
    ?>
    <!doctype html>
    <html lang="id">
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width,initial-scale=1" />
      <title>Admin Ping</title>
      <style>
        :root{--bg:#0f1724;--card:#0b1220;--muted:#94a3b8;--accent:#7c3aed;--accent-2:#06b6d4}
        *{box-sizing:border-box;margin:0;padding:0}
        html,body{height:100%;font-family:Inter,system-ui,Segoe UI,Roboto,Helvetica,Arial;color:#e6eef8;background:
          radial-gradient(1200px 600px at 10% 10%, rgba(124,58,237,0.12), transparent 6%),
          radial-gradient(900px 400px at 90% 90%, rgba(6,182,212,0.08), transparent 8%),
          var(--bg);
        }
        .wrap{display:grid;grid-template-columns:320px 1fr;gap:28px;max-width:1100px;margin:48px auto;padding:28px;}
        @media (max-width:900px){ .wrap{grid-template-columns:1fr; padding:18px} .sidebar{order:2} .main{order:1} }
        .sidebar{background:linear-gradient(180deg,var(--card), rgba(11,18,32,0.88));border-radius:14px;padding:20px;box-shadow:0 10px 30px rgba(2,6,23,0.6);min-height:420px;position:relative}
        .brand{display:flex;gap:12px;align-items:center;margin-bottom:18px}
        .logo{width:46px;height:46px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));display:flex;align-items:center;justify-content:center;font-weight:700;color:white}
        .brand h1{font-size:18px;color:#fff}
        .main{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));padding:28px;border-radius:14px;box-shadow:0 10px 30px rgba(3,6,23,0.6);min-height:420px;display:flex;flex-direction:column}
        .panel{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));padding:18px;border-radius:12px;border:1px solid rgba(255,255,255,0.03)}
        .btn { background:linear-gradient(90deg,var(--accent),var(--accent-2)); color:white; padding:12px 16px; border:none; border-radius:8px; cursor:pointer; font-weight:700 }
        .muted { color:var(--muted); font-size:13px }
      </style>
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
      <div class="wrap">
        <div class="sidebar">
          <div class="brand">
            <div class="logo">NCU</div>
            <div>
              <h1>Get Chall</h1>
              <p class="muted">Admin Tools • Ping</p>
            </div>
          </div>
          <div style="margin-top:18px;color:var(--muted);font-size:13px">
            <strong>Instructions:</strong>
            <p style="margin-top:8px">Masukkan IP lalu klik <em>Ping</em></p>
          </div>
        </div>

        <div class="main">
          <div class="panel">
            <h2>Admin Ping Tool</h2>
            <form method="POST">
              <span class="muted">Contoh: 127.0.0.1</span><br>
              <input type="text" name="host" oninput="validateInput(event)">
              <br><br>
              <button class="btn" type="submit">Ping</button>
            </form>
          </div>
        </div>
      </div>
    </body>
    </html>
    <?php
    exit;
}

setcookie('role', 'user', time() + 3600, '/');
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login - Example Shop</title>
  <style>
    :root{--bg:#0f1724;--card:#0b1220;--muted:#94a3b8;--accent:#7c3aed;--accent-2:#06b6d4}
    *{box-sizing:border-box;margin:0;padding:0}
    html,body{height:100%;font-family:Inter,system-ui,Segoe UI,Roboto,Helvetica,Arial;color:#e6eef8;background:
      radial-gradient(1200px 600px at 10% 10%, rgba(124,58,237,0.12), transparent 6%),
      radial-gradient(900px 400px at 90% 90%, rgba(6,182,212,0.08), transparent 8%),
      var(--bg);
    }
    .wrap{max-width:900px;margin:48px auto;padding:28px}
    .card{background:linear-gradient(180deg,var(--card), rgba(11,18,32,0.88));padding:28px;border-radius:12px;box-shadow:0 10px 30px rgba(2,6,23,0.6)}
    h1{color:#fff}
    p.muted{color:var(--muted);margin-top:8px}
    .hint code{background:rgba(255,255,255,0.03);padding:4px 8px;border-radius:6px;color:#cfe8ff}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h1>Login</h1>
      <p class="muted"></p>
      <div style="margin-top:18px">
        <p class="muted">Pesan sistem: anda belum bisa mengakses fitur admin (wleee)</p>
      </div>
    </div>
  </div>
</body>
</html>
