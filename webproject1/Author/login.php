<!DOCTYPE html>
<html lang="en">

<head>
  <title>Online Testing System</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <?php

  require_once("config.php");
  $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
  $pdo = new PDO($connString, DBUSER, DBPASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  session_start();
  $error = '';

  if (empty($_POST['email']) || empty($_POST['pass'])) {
    $error = 'Username or Password is invalid!';
  } else {

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT author_id, email, password from authors where email= '$email' and password = '$pass' LIMIT 1";
    $result = $pdo->query($sql);


    while ($row = $result->fetch()) {
      $_SESSION['login_user'] = $row['author_id'];
      header('location: index.php');
    }
  }

  ?>

</head>

<body>
  <div class="container  pt-4">

    <div class="card m-auto" style="width: 50%;">
      <h4 class="card-header text-center">Please Login</h4>

      <div class="card-body p-3">

      </div>
    </div>
  </div>
</body>

</html>
<form action="" method="POST">
  <div class="form-group">
    <label for="InputEmail">Email address</label>
    <input type="email" required class="form-control" id="InputEmail" name="email" placeholder="Enter email">

  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" required class="form-control" id="InputPassword" name="pass" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>