<?php
require_once("../Models/TestClass.php");
require_once("../Models/PaperClass.php");
require_once("../Models/Question.php");
$test_id = $_POST['test_id'];
$totalQuestions = $_POST['totalQuestions'];
$passingPercentage = $_POST['passingPercentage'];
$test = new Test();
$question = new Question();
$allQuestions = $question->getAllQuestions();
if (count($allQuestions) < $totalQuestions) {
    echo "<div class='container'><h5 class='h5 alert-info w-50 p-5 text-center' >Unfortunately questions in the bank are not enough to create paper. Please enter another figure.
    <a href='createTest.php'>Back</a></h5></div>";
    header("location: createTest.php?status=notEnough");
    return;
}
if (!empty($question->getPaperQuestions($test_id))) {
    echo "<div class='container'><h5 class='h5 alert-info w-50 p-5 text-center' >Paper is already created. Please enter another test Date.
    <a href='createTest.php'>Back</a></h5></div>";
    header("location: createTest.php?status=already");

    return;
}
if ($test->InsertDetails($test_id, $totalQuestions, $passingPercentage)) {
    $paper = array();
    $alreadyEntered = array();

    $counter = 0;
    while ($counter < $totalQuestions) {
        $index = rand(0, count($allQuestions) - 1);
        if (gettype(array_search($index, $alreadyEntered)) == "boolean") {
            echo "already entered:";

            $alreadyEntered[$counter] = $index;
            $paper[$counter] = $allQuestions[$index]->qID;

            $counter++;
        }
    }

    foreach ($paper as $question_id) {
        $paper1 = new Paper();
        $paper1->insert($test_id, $question_id);
        // echo "QUestion IDs:$question_id";
    }
    header("location: createTest.php?status=done");
} else {
    echo 'could not insert details ';
}
