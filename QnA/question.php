<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "questionitout";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
  die("Connection to the database failed due to: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $registrationNo = $_POST['registrationNo'];
  $email = $_POST['email'];
  $question = $_POST['question'];
  $timestamp = date('Y-m-d H:i:s');

  $sql = "INSERT INTO studentquestions (`Name`, `Registration No.`, `Email`, `Question`, `Time Stamp`)
          VALUES ('$name', '$registrationNo', '$email', '$question', '$timestamp')";

  if (mysqli_query($conn, $sql)) {
    $submitMessage = "Question submitted successfully!";
  } else {
    $submitMessage = "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Question It Out - Ask a Question</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    
    <h1><b>Question It Out - Ask a Question</b></h1>

    <?php if (isset($submitMessage)): ?>
      <p class="submit-message"><?php echo $submitMessage; ?></p>
      <div class="buttons">
        <a href="user.php" class="btn">Ask Another Question</a>
        <a href="index.php" class="btn">Go Back</a>
      </div>
    <?php else: ?>
      <p class="submit-message">An error occurred while submitting the question.</p>
    <?php endif; ?>
  </div>
</body>
</html>
