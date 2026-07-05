<?php
require_once 'config.php';
require_once 'templates/header.php';

if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$conn = get_db_connection();

// Ambil semua genre yang tersedia
$genre_sql = "SELECT DISTINCT genre FROM novels WHERE genre IS NOT NULL ORDER BY genre";
$genre_result = $conn->query($genre_sql);
$genres = [];
while($row = $genre_result->fetch_assoc()) {
    $genres[] = $row['genre'];
}

// Query novels (dengan filter jika ada) - VULNERABLE SQL INJECTION
$selected_genre = isset($_POST['genre']) ? $_POST['genre'] : 'all';
$sql = "SELECT * FROM novels";

if ($selected_genre !== 'all') {
    // VULNERABLE: Tidak ada sanitasi atau escaping
    $sql .= " WHERE genre = '" . $selected_genre . "'";
}

$sql .= " ORDER BY title";
$result = $conn->query($sql);
?>

<h2>Novel Collection</h2>

<!-- FORM FILTER BERDASARKAN GENRE (METHOD POST) -->
<form action="novels.php" method="post" style="margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 5px;">
    <div style="display: flex; align-items: center; gap: 10px;">
        <label for="genre" style="font-weight: bold;">Filter by Genre:</label>
        <select id="genre" name="genre" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="all">All Genres</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?php echo htmlspecialchars($genre); ?>">
                    <?php echo htmlspecialchars($genre); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Apply Filter
        </button>
    </div>
</form>

<h3>
    <?php 
    if ($selected_genre === 'all') {
        echo "All Novels";
    } else {
        echo "Novels in Genre: " . htmlspecialchars($selected_genre);
    }
    ?>
    (<?php echo $result->num_rows; ?> results)
</h3>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px;'>";
        echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
        echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
        echo "<p><strong>Genre:</strong> " . htmlspecialchars($row['genre']) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars(substr($row['content'], 0, 150))) . "...</p>";
        echo "</div>";
    }
} else {
    echo "<p>No novels found.</p>";
}

$conn->close();
require_once 'templates/footer.php';
?>