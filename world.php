<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if country parameter exists
if (isset($_GET['country'])) {
    $country = $_GET['country'];
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // No country parameter - return empty or nothing
    $results = [];
}
?>

<?php if (!empty($results)): ?>
<ul>
    <?php foreach ($results as $row): ?>
        <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
    <p>No results found.</p>
<?php endif; ?>