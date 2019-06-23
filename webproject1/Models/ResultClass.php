<?php
require_once("../config.php");

class Result
{
    public $student_id;
    public $test_id;
    public $marks;
    public $test_date;
    public $status;
    public $pdo;
    public function __construct($student_id = null, $test_id = null, $test_date = null, $marks = null, $status = null)
    {
        $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $this->pdo = new PDO($connString, DBUSER, DBPASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->student_id = $student_id;
        $this->test_id = $test_id;
        $this->test_date = $test_date;
        $this->marks = $marks;
        $this->status = $status;
    }

    public function insertResponse($student_id, $test_id, $question_id, $answer)
    {
        $sql = "INSERT INTO studentanswers(student_id, test_id, question_id, answer) VALUES ($student_id,$test_id,$question_id,'$answer');";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    public function getResult($student_id, $test_id)
    {

        $sql = "SELECT * FROM results WHERE student_id = $student_id AND test_id = $test_id";
        $res = $this->pdo->query($sql);
        if ($row = $res->fetch()) {
            return $row['marks'];
        } else {
            return false;
        }
    }

    public function getAllResults($student_id)
    {
        $list = array();
        $sql = "SELECT results.student_id, tests.test_id,tests.test_date,results.marks,results.status
         FROM results join tests
          on tests.test_id=results.test_id
          WHERE results.student_id = $student_id";
        $res = $this->pdo->query($sql);
        $i = 0;
        while ($row = $res->fetch()) {
            $list[$i] = new Result($row['student_id'], $row['test_id'], $row['test_date'], $row['marks'], $row['status']);
            $i++;
        }
        return $list;
    }

    public function createResult($student_id, $test_id)
    {
        $sql = "SELECT count(*) as marks FROM studentanswers join questions 
        on studentanswers.question_id=questions.question_id and studentanswers.answer=questions.answer 
        where studentanswers.test_id=$test_id and studentanswers.student_id=$student_id";
        $res = $this->pdo->query($sql);
        if ($row = $res->fetch()) {
            $marks = $row['marks'];
            $t = new Test();
            $test = $t->getTest($test_id);
            $totalQuestions = $test->totalQuestions;
            $passingPercentage = $test->passingPercentage;
            $per = ($marks / $totalQuestions) * 100;
            $status = "pass";
            if ($per < $passingPercentage) {
                $status = "fail";
            }

            $insertQuery = "insert into results (student_id, test_id, marks, status) values ($student_id, $test_id, $marks, '$status')";
            $count = $this->pdo->exec($insertQuery);
            if ($count > 0)
                return $marks;
            return false;
        } else {
            return false;
        }
    }
}
