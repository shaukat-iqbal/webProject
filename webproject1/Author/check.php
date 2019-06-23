
<?php
require_once("../Models/Question.php");
$q = new Question();
print_r($q->getPaperQuestions(2));

?>