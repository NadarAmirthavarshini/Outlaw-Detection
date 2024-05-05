<?php
// Include the database config file
//include('Database.php');

$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'country';

// Create connection
$link = new mysqli($servername, $username, $password, $db);

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

if (!empty($_POST['iso2_val'])) {

    $getStateiso2 = $_POST['iso2_val'];
    echo $getStateiso2;

    // Fetch city data based on the specific state id
    $query = "SELECT * FROM cities WHERE state_id = " . $getStateiso2 . " ORDER BY city_name ASC";
    $result = $link->query($query);

    // Generate HTML of city options list
    if ($result->num_rows > 0) {
        echo '<option value="">Select city</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>';
        }
    } else {
        echo '<option value="">City not available</option>';
    }
}
