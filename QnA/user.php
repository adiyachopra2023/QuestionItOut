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

    <form action="question.php" method="post">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="text" name="registrationNo" placeholder="Registration No." required>
      <input type="email" name="email" placeholder="Email" required>
      <textarea name="question" placeholder="Your Question" required></textarea><br>
      <button class="btn" type="submit">Ask</button>
      <button class="btn" type="reset">Reset</button>
    </form>
    <br><a href="index.php" class="btn">Go Back</a>
  </div>
</body>
<script>
    function goBack() {
      window.history.back();
    }
</script>
</html>
