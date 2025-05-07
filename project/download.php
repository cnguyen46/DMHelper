<?php
// Database connection (MMAP phpMyAdmin settings)
$host = 'localhost';
$port = 8889;
$user = 'root';
$pass = 'root';
$db   = 'project';

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set headers for download
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="players_info.txt"');

// Query the players table
$query = "SELECT playerName, className, level, strength, dexterity, constitution, intelligence, wisdom, charisma FROM players";
$result = $conn->query($query);

// Output formatted text
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "Name: {$row['playerName']}\n";
    echo "Class: {$row['className']}\n";
    echo "Level: {$row['level']}\n";
    echo "STR: {$row['strength']}\n";
    echo "DEX: {$row['dexterity']}\n";
    echo "CON: {$row['constitution']}\n";
    echo "INT: {$row['intelligence']}\n";
    echo "WIS: {$row['wisdom']}\n";
    echo "CHA: {$row['charisma']}\n";
    echo "--------------------------\n";
  }
} else {
    echo "No players found.\n";
}

$conn->close();
exit;
?>
