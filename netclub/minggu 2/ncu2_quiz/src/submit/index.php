<?php

$FLAG_VALID = "NCU{congr4ts_your_flag_1s_h3re}"; 
$SCORE_FILE = __DIR__ . "/score.json";

function read_scores(string $file): array {
    if (!file_exists($file)) return [];
    $json = file_get_contents($file);
    $arr = json_decode($json, true);
    return is_array($arr) ? $arr : [];
}

function write_scores(string $file, array $scores): bool {
    $tmp = $file . ".tmp";
    $written = file_put_contents($tmp, json_encode($scores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    if ($written === false) return false;
    return rename($tmp, $file);
}

$message = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string)($_POST['name'] ?? ''));
    $flag = trim((string)($_POST['flag'] ?? ''));

    if ($name === '' || $flag === '') {
        $err = "Nama dan flag wajib diisi.";
    } else {
        $name = substr(preg_replace('/[\r\n]+/', ' ', $name), 0, 64);

        if ($flag === $FLAG_VALID) {
            $now = microtime(true);

            $scores = [];
            if (!file_exists($SCORE_FILE)) {
                file_put_contents($SCORE_FILE, json_encode([], JSON_PRETTY_PRINT));
            }

            $fp = fopen($SCORE_FILE, 'c+');
            if ($fp === false) {
                $err = "Gagal membuka file scoreboard.";
            } else {
                if (flock($fp, LOCK_EX)) {
                    $contents = stream_get_contents($fp);
                    $scores = json_decode($contents ?: '[]', true);
                    if (!is_array($scores)) $scores = [];

                    $exists = false;
                    foreach ($scores as $row) {
                        if (strcasecmp($row['name'] ?? '', $name) === 0) {
                            $exists = true;
                            break;
                        }
                    }

                    if ($exists) {
                        $err = "Nama sudah terdaftar di scoreboard. Gunakan nama lain.";
                    } else {
                        $scores[] = [
                            'name' => $name,
                            'ts'   => $now
                        ];
                        usort($scores, function($a, $b) {
                            return ($a['ts'] <=> $b['ts']);
                        });

                        ftruncate($fp, 0);
                        rewind($fp);
                        fwrite($fp, json_encode($scores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                        fflush($fp);
                        flock($fp, LOCK_UN);

                        header("Location: scoreboard.php");
                        fclose($fp);
                        exit;
                    }

                    flock($fp, LOCK_UN);
                } else {
                    $err = "Gagal mengunci file scoreboard.";
                }
                fclose($fp);
            }
        } else {
            $err = "Flag salah — ditolak.";
        }
    }
}

?><!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Submit Flag — Single Challenge</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    :root{
      --bg:#0f1724;--card:#0b1220;--muted:#94a3b8;--accent:#7c3aed;--accent-2:#06b6d4;
    }
    *{box-sizing:border-box}
    body{font-family:Inter,system-ui,Segoe UI,Roboto,Arial;background:
      radial-gradient(800px 300px at 10% 20%, rgba(124,58,237,0.10), transparent 6%),
      var(--bg);color:#e6eef8;margin:0;padding:40px;}
    .box{max-width:720px;margin:0 auto;background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));padding:28px;border-radius:12px;border:1px solid rgba(255,255,255,0.03)}
    h1{margin:0 0 8px 0}
    p.lead{color:var(--muted);margin-top:0}
    form{margin-top:18px;display:grid;gap:12px}
    label{font-size:13px;color:var(--muted)}
    input[type="text"]{padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);background:transparent;color:#eaf4ff}
    button{background:linear-gradient(90deg,var(--accent),var(--accent-2));border:none;padding:10px 14px;border-radius:8px;color:#fff;font-weight:700;cursor:pointer}
    .msg{margin-top:12px;padding:10px;border-radius:8px}
    .err{background:#3b0b0b;color:#ffdede;border:1px solid rgba(255,0,0,0.08)}
    .ok{background:#072915;color:#dfffe9;border:1px solid rgba(0,255,100,0.06)}
    .small{font-size:13px;color:var(--muted)}
    .scorelink{margin-top:14px;display:inline-block;color:#cfe8ff;text-decoration:none}
  </style>
</head>
<body>
  <div class="box">
    <h1>Submit Flag</h1>
    <p class="lead">Masukkan Namamu dan Flag untuk challenge ini.</p>

    <?php if ($err): ?>
      <div class="msg err"><?php echo htmlspecialchars($err, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
      <div>
        <label>Nama</label><br>
        <input type="text" name="name" maxlength="64" required value="<?php echo isset($name) ? htmlspecialchars($name, ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8') : ''; ?>">
      </div>

      <div>
        <label>Flag</label><br>
        <input type="text" name="flag" maxlength="256" required>
      </div>

      <div style="display:flex;gap:12px;align-items:center">
        <button type="submit">Kirim</button>
        <a class="scorelink" href="scoreboard.php">Lihat scoreboard →</a>
      </div>
      <p class="small">Catatan: setiap nama hanya boleh dipakai sekali. Gunakan nama unik agar terdaftar.</p>
    </form>
  </div>
</body>
</html>
