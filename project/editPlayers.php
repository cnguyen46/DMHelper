<?php
// 1. Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. DB connection
$host = 'localhost';
$port = 8889;
$user = 'root';
$pass = 'root';
$db = 'project';

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 3. Handle POST (form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerID = $_POST['playerID'];
    $playerName = $_POST['playerName'];
    $className = ucfirst(trim($_POST['className'])); // First letter capitalized
    $level = $_POST['level'];

    $strength = $_POST['strength'];
    $dexterity = $_POST['dexterity'];
    $constitution = $_POST['constitution'];
    $intelligence = $_POST['intelligence'];
    $wisdom = $_POST['wisdom'];
    $charisma = $_POST['charisma'];

    $stmt = $conn->prepare("
        UPDATE players
           SET playerName=?, className=?, level=?,
               strength=?, dexterity=?, constitution=?,
               intelligence=?, wisdom=?, charisma=?
         WHERE playerID=?
    ");
    $stmt->bind_param(
        "ssiiiiiiii",
        $playerName, $className, $level,
        $strength, $dexterity, $constitution,
        $intelligence, $wisdom, $charisma,
        $playerID
    );
    $stmt->execute();

    // 4. Get ALL player IDs
    $idQuery = "SELECT playerID FROM players";
    $idResult = $conn->query($idQuery);
    $allIds = [];
    while ($row = $idResult->fetch_assoc()) {
        $allIds[] = $row['playerID'];
    }
    $idString = implode(",", $allIds);

    // 5. Redirect to view all players
    header("Location: viewPlayers.php?ids={$idString}");
    exit;
}

// 6. Load player info for editing
if (empty($_GET['id'])) {
    die("Player ID not provided.");
}
$playerID = intval($_GET['id']);

$sql = "SELECT * FROM players WHERE playerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $playerID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Player not found.");
}
$player = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Player: <?= htmlspecialchars($player['playerName']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles_party.css">
</head>
<body>
  <main class="center-content">
    <h1 id="main-title">Edit Player: <?= htmlspecialchars($player['playerName']) ?></h1>

    <form method="POST">
      <input type="hidden" name="playerID" value="<?= $playerID ?>">

      <table>
        <thead>
          <tr>
            <th>Field</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><label>Name</label></td>
            <td><input type="text" name="playerName" class="form-control" value="<?= htmlspecialchars($player['playerName']) ?>" required></td>
          </tr>

          <tr>
            <td><label>Class</label></td>
            <td>
              <select name="className" class="form-control" required>
                <option value="Cleric" <?= $player['className'] == 'Cleric' ? 'selected' : '' ?>>Cleric</option>
                <option value="Mage" <?= $player['className'] == 'Mage' ? 'selected' : '' ?>>Mage</option>
                <option value="Ranger" <?= $player['className'] == 'Ranger' ? 'selected' : '' ?>>Ranger</option>
                <option value="Rogue" <?= $player['className'] == 'Rogue' ? 'selected' : '' ?>>Rogue</option>
                <option value="Warrior" <?= $player['className'] == 'Warrior' ? 'selected' : '' ?>>Warrior</option>
              </select>
            </td>
          </tr>

          <tr>
            <td><label>Level</label></td>
            <td><input type="number" name="level" class="form-control" value="<?= $player['level'] ?>" min="1" max="20" required></td>
          </tr>

          <tr>
            <td><label>STR</label></td>
            <td><input type="number" name="strength" class="form-control" value="<?= $player['strength'] ?>" min="1" max="30" required></td>
          </tr>

          <tr>
            <td><label>DEX</label></td>
            <td><input type="number" name="dexterity" class="form-control" value="<?= $player['dexterity'] ?>" min="1" max="30" required></td>
          </tr>

          <tr>
            <td><label>CON</label></td>
            <td><input type="number" name="constitution" class="form-control" value="<?= $player['constitution'] ?>" min="1" max="30" required></td>
          </tr>

          <tr>
            <td><label>INT</label></td>
            <td><input type="number" name="intelligence" class="form-control" value="<?= $player['intelligence'] ?>" min="1" max="30" required></td>
          </tr>

          <tr>
            <td><label>WIS</label></td>
            <td><input type="number" name="wisdom" class="form-control" value="<?= $player['wisdom'] ?>" min="1" max="30" required></td>
          </tr>

          <tr>
            <td><label>CHA</label></td>
            <td><input type="number" name="charisma" class="form-control" value="<?= $player['charisma'] ?>" min="1" max="30" required></td>
          </tr>
        </tbody>
      </table>
      <button type="reset" class="btnDetail">Reset</button>
      <button type="submit" class="btnSave">Save Changes</button> <br><br><br>
    </form>
    <footer>
      <p>&copy; 2025 🧙‍♂️ DMHelper</p>
    </footer>
  </main>
</body>
</html>


<?php
$conn->close();
?>
