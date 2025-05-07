<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['content'];
    $rating = $_POST['rating'];

    // Database connection (using your provided credentials)
    $host = 'localhost';
    $port = 8889;
    $user = 'root';
    $pass = 'root';
    $db = 'project';

    $conn = new mysqli($host, $user, $pass, $db, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert feedback into the database
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, content, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $content, $rating);

    if ($stmt->execute()) {
        // Redirect to title.html after successful submission
        header("Location: title.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Thank you</title>
  <link rel="stylesheet" href="css/styles_feedback.css">
</head>

<body>
  <main>
    <header>
      <h1>Thank You for Trying the Demo!</h1>
    </header>
    <form method="POST" action="feedback.php">
      <h2>Please write any comment.</h2>
      <label for="name"> Name:</label>
      <input type="text" id="name" name="name" required>
      <label for="email"> Email:</label>
      <input type="email" id="email" name="email" required>
      <textarea id="feedbackText" name="content" rows="5" cols="50" placeholder="Write your comment here..."></textarea>

      <div id="starRating" style="margin: 20px;">
        <span class="star" data-value="1">&#9733;</span>
        <span class="star" data-value="2">&#9733;</span>
        <span class="star" data-value="3">&#9733;</span>
        <span class="star" data-value="4">&#9733;</span>
        <span class="star" data-value="5">&#9733;</span>
      </div>

      <input type="hidden" id="rating" name="rating" value="0">
      
      <button id="submitBtn">Submit</button>
    </form>
    <nav>
      <a href="title.html">Going back to Homepage</a>
    </nav>
    <footer>
      <p>&copy; 2025 🧙‍♂️ DMHelper</p>
    </footer>
  </main>
  <script src="js/Feedback.js"></script>
</body>

</html>
