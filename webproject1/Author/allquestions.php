<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>All Question | Online Testing System</title>

    <?php

    require_once("../Models/Question.php");
    require_once("../Models/Author.php");
    // require_once("config.php");
    $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
    $pdo = new PDO($connString, DBUSER, DBPASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // session_start();

    if ($_SESSION['login_user']) {
        $userID = $_SESSION['login_user'];
        json_decode($userID, true);
        $author = new Author();
        $result =  $author->GetAuthorQuestions($userID);


        // $sID = $allQuestions['subject_id'];
        // $sql = 'select * from subjects where subject_id=' . $sID;
        // $sub = $pdo->query($sql);
        // $subName = $sub->fetch();
    } else {
        header('location: login.php');
    }

    // echo "<script type='text/javascript'>alert('Are you sure?');</script>";

    ?>


</head>

<body>
    <?php
    include_once("navigation.html");
    ?>
    <div class="container mt-4">
        <h2>All Questions</h2>

        <table class="table table-hover table-striped">

            <th>Description</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Answer</th>
            <th></th>


            <?php
            while ($allQuestions = $result->fetch()) {
                ?>
                <tr>
                    <td>

                        <?php
                        echo $allQuestions['description']
                        ?>

                    </td>
                    <td>

                        <?php
                        echo $allQuestions['option1']
                        ?>

                    </td>
                    <td>

                        <?php
                        echo $allQuestions['option2']
                        ?>

                    </td>
                    <td>

                        <?php
                        echo $allQuestions['option3']
                        ?>

                    </td>
                    <td>

                        <?php
                        echo $allQuestions['answer']
                        ?>

                    </td>

                    <td>
                        <a href="questionEdit.php?id=<?= $allQuestions['question_id'] ?>">
                            <button type="button" class="btn btn-primary">Edit</button>
                        </a>
                        <a href="questiondelete.php?id=<?= $allQuestions['question_id'] ?>">
                            <input type="submit" class="btn btn-danger" name="deleteBtn" value="Delete" />
                        </a>
                    </td>

                </tr>
            <?php
        }
        ?>
        </table>
    </div>
</body>

</html>