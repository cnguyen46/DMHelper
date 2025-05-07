<?php
// 1) Enable errors during development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2) DB connection (same as before)
$host = 'localhost';
$port = 8889;
$user = 'root';
$pass = 'root';
$db = 'project';

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3) Delete all data when "Start Over" button is pressed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resetPlayers'])) {
    $deleteQuery = "DELETE FROM players";

    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: mainpage.html"); // Redirect after deletion
        exit;
    } else {
        // Error in query
        die("Error deleting records: " . $conn->error);
    }
}

// 4) Get IDs from query string (sanitize)
if (empty($_GET['ids'])) {
    die("No player IDs provided.");
}
$idList = preg_replace('/[^0-9,]/', '', $_GET['ids']); // sanitize

// 5) Fetch those players
$sql = "
  SELECT playerID, playerName, className, level,
         strength, dexterity, constitution,
         intelligence, wisdom, charisma
    FROM players
   WHERE playerID IN ({$idList})
   ORDER BY FIELD(playerID, {$idList})
";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// 6) Render an HTML page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Players Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles_party.css">
</head>
<body>
  <main class="center-content">
    <header>
      <h1 id="main-title">🔥 Players Information 🔥</h1>
    </header>
    <section class="box" style="display: flex; justify-content: left; gap: 1rem; margin-top: 2rem;">
      <h2 id="subtitle" > For more details:
        <a href="cleric.html" target="_blank">
          <button class="btnDetail"> Class Details </button>
        </a>
        <a href="ability.html" target="_blank">
          <button class="btnDetail"> Ability Details </button>
        </a>
        <a href="feedback.php" target="_blank">
          <button class="btnDetail"> 📩 Feedback </button>
        </a>
      </h2>
    </section>  

    <section class="box">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Class</th>
            <th>Level</th>
            <th>STR</th>
            <th>DEX</th>
            <th>CON</th>
            <th>INT</th>
            <th>WIS</th>
            <th>CHA</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['playerName']) ?></td>
            <td><?= ucfirst(htmlspecialchars($row['className'])) ?></td>
            <td><?= htmlspecialchars($row['level']) ?></td>
            <td><?= htmlspecialchars($row['strength']) ?></td>
            <td><?= htmlspecialchars($row['dexterity']) ?></td>
            <td><?= htmlspecialchars($row['constitution']) ?></td>
            <td><?= htmlspecialchars($row['intelligence']) ?></td>
            <td><?= htmlspecialchars($row['wisdom']) ?></td>
            <td><?= htmlspecialchars($row['charisma']) ?></td>
            <td><a href="editPlayers.php?id=<?= $row['playerID'] ?> "class="btnEdit">Edit</a></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

      <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 2rem;">
        <form method="POST" onsubmit="return confirmReset();">
          <input type="hidden" name="resetPlayers" value="1">
          <button type="submit" class="btnStartOver">Start Over</button>
        </form>

        <form action="download.php" method="get">
          <button type="submit" class="btnSave">Save the progress</button>
          <br><br><br>
        </form>
      </div>

      <script>
      function confirmReset() {
        return confirm("Ready to start fresh? You will lose current info unless you save first.");
      }
      </script>
    </section>
    <footer>
      <p>&copy; 2025 🧙‍♂️ DMHelper</p>
    </footer>
  </main>
</body>
  
</html>
<?php
$conn->close();
?>
