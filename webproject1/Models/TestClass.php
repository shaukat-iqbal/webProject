<?php
require_once("../config.php");
class Test
{
    public $test_date;
    public $test_time;
    public $test_id;
    public $paper;
    public $passingPercentage;
    public $totalQuestions;
    public $pdo;

    public function __construct($test_id = null, $test_date = null, $test_time = null, $paper = null, $passingPercentage = null, $totalQuestions = null)
    {
        $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $this->pdo = new PDO($connString, DBUSER, DBPASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->test_id = $test_id;
        $this->test_date = $test_date;
        $this->test_time = $test_time;
        $this->paper = $paper;
        $this->passingPercentage = $passingPercentage;
        $this->totalQuestions = $totalQuestions;
    }

    public function getAnnoncedTests()
    {
        $testList = array();
        $month = date('m');
        $year = date('y');
        $sql = "select * from tests where test_date between '$year/$month/01' and '$year/$month/31'";
        $res = $this->pdo->query($sql);
        $i = 0;
        while ($test = $res->fetch()) {
            $test_date = explode(" ", $test['test_date'])[0];
            $test_time = explode(" ", $test['test_date'])[1];
            $testList[$i] = new Test($test['test_id'], $test_date, $test_time);
            $i++;
        }
        return $testList;
    }

    public function InsertDetails($test_id, $totalQuestions, $passingPercentage)
    {
        // TODO: Write Definition to insert record into database
        $sql = "UPDATE tests SET totalQuestions = '$totalQuestions', passingPercentage = '$passingPercentage' WHERE test_id = $test_id";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    public function insert($test_date)
    {
        $sql = "INSERT INTO tests (test_id, test_date, totalQuestions, passingPercentage) VALUES (NULL,'$test_date', NULL, NULL);";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    public function getTest($test_id)
    {

        $sql = "select * from tests WHERE test_id = $test_id";
        $result = $this->pdo->query($sql);
        if ($row = $result->fetch()) {
            $test_date = explode(" ", $row['test_date'])[0];
            $test_time = explode(" ", $row['test_date'])[1];

            return new Test($row['test_id'], $test_date, $test_time, null, $row['passingPercentage'], $row['totalQuestions']);
        }
        return false;
    }
    public function getTestByDate($month)
    {
        $year = date('y');
        $sql = "select * from  tests where test_date between '$year-$month-01' and '$year-$month-31'";
        $result = $this->pdo->query($sql);
        if ($row = $result->fetch()) {
            $test_date = explode(" ", $row['test_date'])[0];
            $test_time = explode(" ", $row['test_date'])[1];

            return new Test($row['test_id'], $test_date, $test_time, null, $row['passingPercentage'], $row['totalQuestions']);
        }
        return false;
    }
}
