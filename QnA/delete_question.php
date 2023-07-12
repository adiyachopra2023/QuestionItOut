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
  if (isset($_POST['questionId'])) {
    $questionId = $_POST['questionId']; // Retrieve the questionId from the POST request

    // Sanitize the questionId to prevent SQL injection
    $questionId = mysqli_real_escape_string($conn, $questionId);

    // Construct the delete query
    $deleteSql = "DELETE FROM studentquestions WHERE `S. No.` = '$questionId'";


    if (mysqli_query($conn, $deleteSql)) {
      $deleteMessage = "Question deleted successfully!";
    } else {
      $deleteMessage = "Error deleting question: " . mysqli_error($conn);
    }
  }
}

mysqli_close($conn);
header("Location: admin.php"); // Redirect back to admin.php
exit();
?>
