<?php
require_once("../config.php");
class Paper
{
    public  $test_id;
    public  $question_id;
    public  $pdo;

    public function __construct($test_id = null, $question_id = null)
    {
        $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $this->pdo = new PDO($connString, DBUSER, DBPASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->test_id = $test_id;
        $this->questin_id = $question_id;
    }

    public function insert($test_id, $question_id)
    {
        // TODO: Write Definition to insert record into database
        $sql = "INSERT INTO papers (question_id,test_id) VALUES ($question_id, $test_id)";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }
}
