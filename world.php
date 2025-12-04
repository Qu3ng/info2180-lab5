<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities') {
    // Cities lookup
    if (isset($_GET['country'])) {
        $country = $_GET['country'];
        $stmt = $conn->query("SELECT cities.name, cities.district, cities.population 
                              FROM cities 
                              JOIN countries ON cities.country_code = countries.code 
                              WHERE countries.name LIKE '%$country%' 
                              ORDER BY cities.population DESC");
    } else {
        $stmt = $conn->query("SELECT cities.name, cities.district, cities.population 
                              FROM cities 
                              ORDER BY cities.population DESC 
                              LIMIT 50");
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($results)) {
        echo '<table>';
        echo '<thead><tr><th>Name</th><th>District</th><th>Population</th></tr></thead>';
        echo '<tbody>';
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['district'] . '</td>';
            echo '<td>' . $row['population'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No cities found.</p>';
    }
    
} else {
    // Country lookup (original functionality)
    if (isset($_GET['country'])) {
        $country = $_GET['country'];
        $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
    } else {
        $stmt = $conn->query("SELECT * FROM countries");
    }
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($results)) {
        echo '<table>';
        echo '<thead><tr><th>Name</th><th>Continent</th><th>Independence</th><th>Head of State</th></tr></thead>';
        echo '<tbody>';
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['continent'] . '</td>';
            echo '<td>' . $row['independence_year'] . '</td>';
            echo '<td>' . $row['head_of_state'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No results found.</p>';
    }
}
?>