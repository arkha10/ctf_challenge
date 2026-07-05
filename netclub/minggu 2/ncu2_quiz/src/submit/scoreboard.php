<?php
$SCORE_FILE = __DIR__ . "/score.json";

function read_scores(string $file): array {
    if (!file_exists($file)) return [];
    $json = file_get_contents($file);
    $arr = json_decode($json, true);
    return is_array($arr) ? $arr : [];
}

$scores = read_scores($SCORE_FILE);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Scoreboard — Single Challenge</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    :root{--bg:#071025;--card:#06121b;--muted:#94a3b8;--accent:#7c3aed;--accent-2:#06b6d4}
    body{font-family:Inter,system-ui,Segoe UI,Roboto,Arial;background:var(--bg);color:#e6eef8;margin:0;padding:40px}
    .wrap{max-width:900px;margin:0 auto}
    .card{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));padding:20px;border-radius:12px;border:1px solid rgba(255,255,255,0.03)}
    h1{margin:0 0 8px}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:10px;text-align:left;border-bottom:1px solid rgba(255,255,255,0.03)}
    th{color:var(--muted);font-weight:700}
    td.name{font-weight:700}
    td.time{color:var(--muted);width:220px}
    .empty{color:var(--muted);padding:18px}
    .btn{display:inline-block;margin-top:12px;padding:8px 12px;border-radius:8px;background:linear-gradient(90deg,var(--accent),var(--accent-2));color:#fff;text-decoration:none}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card">
      <h1>Scoreboard</h1>
      <p class="muted">Daftar peserta yang berhasil submit flag (diurutkan berdasarkan waktu submit — tercepat di atas).</p>

      <?php if (empty($scores)): ?>
        <div class="empty">Belum ada peserta yang berhasil submit.</div>
      <?php else: ?>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Waktu Submit</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($scores as $i => $row): 
              $displayTime = isset($row['ts']) ? date("Y-m-d H:i:s", (int)$row['ts']) . sprintf(".%03d", ($row['ts'] - (int)$row['ts'])*1000) : '-';
            ?>
            <tr>
              <td><?php echo $i+1; ?></td>
              <td class="name"><?php echo htmlspecialchars($row['name'] ?? '-', ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'); ?></td>
              <td class="time"><?php echo $displayTime; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

      <a class="btn" href="index.php">Kembali ke Submit</a>
    </div>
  </div>
</body>
</html>
