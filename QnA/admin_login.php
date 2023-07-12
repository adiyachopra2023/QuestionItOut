<?php
session_start();

$maxAttempts = 3; // Maximum number of login attempts
$adminEmail = 'adiya.chopra2022@gmail.com'; // Email address to notify for failed login attempts

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validate the admin's username and password
  if ($username === 'admin' && $password === '@youneverknow@') {
    $_SESSION['admin'] = true;
    header("Location: admin-dashboard.php");
    exit();
  } else {
    $errorMessage = "Invalid username or password";
    $loginAttempts = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
    $_SESSION['login_attempts'] = $loginAttempts;

    if ($loginAttempts >= $maxAttempts) {
      // Send email notification for 3 failed login attempts
      $subject = 'Unauthorized Login Attempt';
      $message = "There have been 3 failed login attempts on the admin panel.";
      $headers = "From: admin@example.com"; 
      
      //mail($adminEmail, $subject, $message, $headers);

      // Reset login attempts
      unset($_SESSION['login_attempts']);

      // Redirect to prevent further login attempts
      header("Location: admin_login.php");
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Question It Out - Admin Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1><b>Question It Out - Admin Login</b></h1>

    <form action="admin.php" method="post">
      <input type="text" name="username" placeholder="Enter username" required>
      <input type="password" name="password" placeholder="Enter password" required>
      <br>
      <button class="btn" type="submit">Login</button>
    </form>

    <?php if (isset($errorMessage)): ?>
      <p class="error-message"><?php echo $errorMessage; ?></p>
      <script>
        // Reset fields and show alert for invalid username or password
        document.querySelector("form").reset();
        alert("Invalid username or password");
      </script>
    <?php endif; ?>
  </div>
</body>
</html>
