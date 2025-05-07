<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 1) Database connection
$host     = 'localhost';
$port     = 8889;
$user     = 'root';
$pass     = 'root';
$dbname   = 'project';

$conn = new mysqli($host, $user, $pass, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2) Only handle POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("No data received.");
}

// 3) Grab arrays from form
$names   = $_POST['character-name']   ?? [];
$classes = $_POST['class-selector']   ?? [];
$levels  = $_POST['level']            ?? [];

if (!is_array($names) || !is_array($classes) || !is_array($levels)) {
    die("Form data malformed: expected arrays.");
}

$count = count($names);

// 4) Prepare statements
$lookup = $conn->prepare("
    SELECT strength, dexterity, constitution,
           intelligence, wisdom, charisma
      FROM classes
     WHERE className = ?
");
$insert = $conn->prepare("
    INSERT INTO players
      (playerName, className, level,
       strength, dexterity, constitution,
       intelligence, wisdom, charisma)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$lookup || !$insert) {
    die("Prepare failed: " . $conn->error);
}

// 5) Bind insert parameters
$insert->bind_param(
    'ssiiiiiii',
    $playerName, $className, $level,
    $strength, $dexterity, $constitution,
    $intelligence, $wisdom, $charisma
);

// 6) Initialize an array to store player IDs
$insertedIds = [];

// 7) Loop and execute
for ($i = 0; $i < $count; $i++) {
    $playerName = trim($names[$i]);
    $className  = trim($classes[$i]);
    $level      = (int)($levels[$i] ?? 1);

    if ($playerName === '' || $className === '') {
        // skip incomplete entries
        continue;
    }

    // Lookup stats via get_result()
    $lookup->bind_param('s', $className);
    $lookup->execute();
    $result = $lookup->get_result();
    $row    = $result->fetch_assoc();
    $result->free();

    if (! $row) {
        // class not found, skip
        continue;
    }

    // Assign stats
    $strength     = (int)$row['strength'];
    $dexterity    = (int)$row['dexterity'];
    $constitution = (int)$row['constitution'];
    $intelligence = (int)$row['intelligence'];
    $wisdom       = (int)$row['wisdom'];
    $charisma     = (int)$row['charisma'];

    // Insert player record
    if (! $insert->execute()) {
        die("Insert failed for player #".($i+1).": " . $insert->error);
    }

    // Save the last inserted ID
    $insertedIds[] = $conn->insert_id;
}

// 8) Redirect to viewPlayers.php with inserted player IDs
if (!empty($insertedIds)) {
    $idList = implode(',', $insertedIds);
    header("Location: viewPlayers.php?ids={$idList}");
    exit;
} else {
    echo "No players were saved.";
}

$lookup->close();
$insert->close();
$conn->close();

echo "All players saved successfully!";
?>
