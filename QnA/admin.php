<?php
session_start();

// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
  header("Location: admin-login.php");
  exit();
}

$server = "localhost";
$username = "root";
$password = "";
$dbname = "questionitout";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
  die("Connection to the database failed due to: " . mysqli_connect_error());
}

$sql = "SELECT * FROM studentquestions ORDER BY `Time Stamp` DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Question It Out - Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <style>
    

    h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    table {
      width: 80%;
      border-collapse: collapse;
      margin-bottom: 20px;
      margin-left: auto;
  margin-right: auto;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    a {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4caf50;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
    }

    a:hover {
      background-color: #45a049;
    }

    .delete-form {
      display: inline-block;
    }

    .delete-button {
      padding: 5px 10px;
      background-color: #ff0000;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
  <div id="questions-container"></div>
    <h1><b>Question It Out - Admin Dashboard</b></h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Registration No.</th>
        <th>Email</th>
        <th>Question</th>
        <th>Actions</th> <!-- New column for delete buttons -->
      </tr>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?php echo $row['Name']; ?></td>
          <td><?php echo $row['Registration No.']; ?></td>
          <td><?php echo $row['Email']; ?></td>
          <td><?php echo $row['Question']; ?></td>
          <td>
          <form action="delete_question.php" method="post">
              <input type="hidden" name="questionId" value="<?php echo $row['S. No.']; ?>">
              <button class="delete-button" type="submit">Delete</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>

    <a href="admin_login.php">Logout</a>
    <!-- Add an empty div to display the updated questions -->



  </div>
</body>
</html>
