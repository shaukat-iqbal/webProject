<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title>Online Testing System</title>
  <?php
  require("../Models/Question.php");
  require("../Models/Author.php");
  $connString = "mysql:host=localhost;dbname=testing";
  $pdo = new PDO($connString, "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $userID = '';
  $author_name = '';
  // session_start();

  if ($_SESSION['login_user']) {
    $userID = $_SESSION['login_user'];
    json_decode($userID, true);
    $author = new Author();
    $record =   $author->GetAuthor($userID);
    $author_name = $record['name'];
  } else {
    header('location: login.php');
  }


  $sql = 'SELECT subject_id from assignedSubjects where author_id =' . $userID;

  $result =   $pdo->query($sql);

  $row = $result->fetch();


  $description = $option1 = $option2 = $option3 = $answer = '';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = new Question();

    // for radio button

    if (isset($_POST['check_option'])) {
      if ($_POST['check_option'] == "1") {
        if ($question->Insert($_POST['description'], $row['subject_id'], $_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option1'])) { } else {
          echo 'Something went wrong.';
        }
      } else if ($_POST['check_option'] == "2") {
        if ($question->Insert($_POST['description'], $row['subject_id'], $_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option2'])) { } else {
          echo 'Something went wrong.';
        }
      } else if ($_POST['check_option'] == "3") {
        if ($question->Insert($_POST['description'], $row['subject_id'], $_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option3'])) { } else {
          echo 'Something went wrong.';
        }
      } else {
        echo 'Please select an answer';
      }
    }
  }
  ?>

</head>

<body>
  <?php
  include_once("navigation.html");
  ?>
  <div class="container mt-4">
    <?php

    echo "<h2>Welcome " .  $author_name . "</h2>";
    echo "<hr>"
    ?>

    <form action="" method="POST">
      <!-- question -->
      <div class="form-group">
        <!-- <label for="question">Enter question</label> -->
        <input type="text" required class="form-control" id="description" placeholder="Question statement" name="description" />
      </div>

      <!-- answers -->
      <div class="form-group form-check-inline">
        <input type="radio" class="form-check-input" name="check_option" value="1" checked />
        <input type="text" required class="form-control" id="option1" name="option1" placeholder="Option 1" />
      </div>
      <br />
      <div class="form-group form-check-inline">
        <input type="radio" class="form-check-input" name="check_option" value="2" />
        <input type="text" required class="form-control" id="option2" name="option2" placeholder="Option 2" />
      </div>
      <br />
      <div class="form-group form-check-inline">
        <input type="radio" class="form-check-input" name="check_option" value="3" />
        <input type="text" required class="form-control" id="option3" name="option3" placeholder="Option 3" />
      </div>
      <br />
      <small class="text-muted">Please don't forget to select correct answer</small>

      <br />
      <br />
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>

</html>