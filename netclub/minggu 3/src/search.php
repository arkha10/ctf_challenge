<?php
require_once 'config.php';
require_once 'templates/header.php';

if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// UBAH DARI $_POST KE $_GET
if (isset($_GET['search_term'])) {
    $search_term = $_GET['search_term'];
    
    $conn = get_db_connection();
    
    // VULNERABLE: SQL Injection dalam search function
    $sql = "SELECT * FROM novels 
            WHERE title LIKE '%$search_term%' 
            OR content LIKE '%$search_term%' 
            OR author LIKE '%$search_term%'";
    
    $result = $conn->query($sql);
    ?>

    <h2>Search Results for "<?php echo htmlspecialchars($search_term); ?>"</h2>
    
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div style='border: 1px solid #ddd; padding: 15px; margin-bottom: 10px;'>";
            echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
            echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
            echo "<p>" . nl2br(htmlspecialchars(substr($row['content'], 0, 150))) . "...</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No novels found matching your search.</p>";
    }
    
    $conn->close();
} else {
    // Jika tidak ada search term, redirect ke novels
    header("Location: novels.php");
    exit();
}
?>

<br>
<a href="novels.php">← Back to Novels</a>

<?php require_once 'templates/footer.php'; ?>