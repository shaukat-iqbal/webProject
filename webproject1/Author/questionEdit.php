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

    <title>Edit | Online Testing System</title>
    <?php
    require_once("../Models/Question.php");
    $question_id = $description = $option1 = $option2 = $option3 = $answer = $subject_id = '';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $question_id = $_GET['id'];
        $question = new Question();
        $questionObj = $question->GetSingleRecord($question_id);

        if ($questionObj) {
            $question_id = $questionObj['question_id'];
            $description = $questionObj['description'];
            $option1 = $questionObj['option1'];
            $option2 = $questionObj['option2'];
            $option3 = $questionObj['option3'];
            $answer = $questionObj['answer'];
            $subject_id = $questionObj['subject_id'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $question = new Question();

        if (isset($_POST['check_option'])) {
            if ($_POST['check_option'] == "1") {
                if ($question->Update($_POST['question_id'], $_POST['description'], $_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option1'], $_POST['subject_id'])) {
                    header("location: allquestions.php");
                }
            } else if ($_POST['check_option'] == "2") {
                if ($question->Update($_POST['question_id'], $_POST['description'], $_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option2'], $_POST['subject_id'])) {
                    header("location: allquestions.php");
                }
            } else if ($_POST['check_option'] == "3") {
                if ($question->Update($_POST['question_id'], $_POST['description'], $_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option3'], $_POST['subject_id'])) {
                    header("location: allquestions.php");
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

        <form action="" method="POST">
            <input type="hidden" name="question_id" value="<?= $question_id ?>">
            <input type="hidden" name="subject_id" value="<?= $subject_id ?>">

            <!-- question -->
            <div class="form-group">
                <!-- <label for="question">Enter question</label> -->
                <input type="text" class="form-control" value="<?= $description ?>" id="description" placeholder="Question statement" name="description" />
            </div>

            <!-- answers -->
            <div class="form-group form-check-inline">
                <input type="radio" class="form-check-input" name="check_option" value="1" <?php echo ($answer == $option1 ? 'checked' : ''); ?> />
                <input type="text" class="form-control" id="option1" value="<?= $option1 ?>" name="option1" placeholder="Option 1" />
            </div>
            <br />
            <div class="form-group form-check-inline">
                <input type="radio" class="form-check-input" name="check_option" value="2" <?php echo ($answer == $option2 ? 'checked' : ''); ?> />
                <input type="text" class="form-control" id="option2" name="option2" value="<?= $option2 ?>" placeholder="Option 2" />
            </div>
            <br />
            <div class="form-group form-check-inline">
                <input type="radio" class="form-check-input" name="check_option" value="3" <?php echo ($answer == $option3 ? 'checked' : ''); ?> />
                <input type="text" class="form-control" id="option3" name="option3" value="<?= $option3 ?>" placeholder="Option 3" />
            </div>
            <br />

            <small class="text-muted">Please don't forget to select correct answer</small>

            <br />
            <br />
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>

</html>