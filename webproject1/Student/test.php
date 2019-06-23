<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        html,
        body {
            height: 100%;
        }
    </style>
    <?php
    require_once("navigation.html");
    require_once("../Models/StudentClass.php");
    require_once("../Models/ResultClass.php");
    require_once("../Models/Question.php");
    $std = new Student();
    if (!$std->checkEnrollmentById($_SESSION['login_user'])) {

        echo "<div class='container'><div class='row'><div class='mt-5 card-body w-25'> <p id='msg' class='alert alert-info'>You are Not enrolled in the test</p></div></div></div>";
        ?>

    <?php

} else {

    $test_date = explode(" ", $_SESSION['test_date'])[0];
    $time = explode(" ", $_SESSION['test_date'])[1];
    //&& $time <= date("H:i:s")
    if (!($test_date != date("y-m-d"))) {
        echo "<h4 class='h4 text-center'>Test will be on $test_date at $time sharp.</h4>";
    } else {
        $qsn = new Question();
        $result = new Result();

        if (!$result->getResult($_SESSION['login_user'], $_SESSION['test_id'])) {
            $questionsList = $qsn->getPaperQuestions($_SESSION['test_id']);
            if (!isset($_SESSION['index'])) {
                $index = 0;
                $_SESSION['index'] = $index;
            } else {
                $index = $_SESSION['index'];
            }
            if ($index < count($questionsList)) {
                $question = $questionsList[$index];
                ?>
                </head>

                <body>

                    <div class="container">
                        <form action="response.php" method="POST">
                            <!-- question -->
                            <input type="hidden" name="question_id" value="<?= $question->qID ?>" />
                            <div class="form-group">
                                <!-- <label for="question">Enter question</label> -->
                                <input type="text" disabled required class="form-control" id="description" value='<?= $question->description ?>' name="description" />
                            </div>

                            <!-- answers -->
                            <div class="form-group form-check-inline">
                                <input type="radio" class="form-check-input" name="answer" value="<?= $question->option1 ?>" checked />
                                <input type="text" disabled required class="form-control" id="option1" name="option1" value="<?= $question->option1 ?>" />
                            </div>
                            <br />
                            <div class="form-group form-check-inline">
                                <input type="radio" class="form-check-input" name="answer" value="<?= $question->option2 ?>" />
                                <input type="text" disabled required class="form-control" id="option2" name="option2" value="<?= $question->option2 ?>" />
                            </div>
                            <br />
                            <div class="form-group form-check-inline">
                                <input type="radio" class="form-check-input" name="answer" value="<?= $question->option3 ?>" />
                                <input type="text" disabled required class="form-control" id="option3" name="option3" value="<?= $question->option3 ?>" />
                            </div>
                            <br />
                            <small class="text-muted">Please don't forget to select correct answer</small>

                            <br />
                            <br />
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>



                </body>
            <?php
        } else {
            //here calculate all marks
            $marks = $result->createResult($_SESSION['login_user'], $_SESSION['test_id']);
            echo $marks;
            echo "<div class='container text-center'><h4 class='h4 text-center'>Test ended your marks are: $marks</h4> <a class='btn btn-primary' href='result.php'>View</a></div>";
        }
    } else {
        echo "<div class='container text-center'><h4 class='h4 text-center'>You have already taken the test.</h4> <a class='btn btn-primary' href='result.php'>View Result</a></div>";
    }
}
}

?>

</html>