
<?php
require_once("../Models/Question.php");
if (isset($_POST['question_id']) && isset($_POST['answer'])) {
    if (isset($_SESSION['index'])) {
        $index =  $_SESSION['index'];
        $index++;
    } else {
        $index = 1;
    }
    $_SESSION['index'] = $index;
    $qstn = new Question();
    $res = $qstn->insertResponse($_SESSION['login_user'], $_SESSION['test_id'], $_POST['question_id'], $_POST['answer']);
    if ($res) {
        header("Location: test.php");
    } else {
        echo "could not enter response in db";
    }
} else {
    echo "something missing";
}

?>
