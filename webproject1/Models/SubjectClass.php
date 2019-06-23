<?php
// require_once("config.php");

class Subject
{
    public $subject_id;
    public $subject_name;
    public $pdo;

    public function __construct($subject_id = null, $subject_name = null)
    {
        $connString = "mysql:host=localhost;dbname=testing";
        $this->pdo = new PDO($connString, "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->subject_id  = $subject_id;
        $this->subject_name  = $subject_name;
    }

    public function getSubjectById($subject_id)
    {
        $sql = "SELECT * FROM subjects WHERE subject_id=$subject_id";
        $res = $this->pdo->query($sql);
        if ($row = $res->fetch()) {
            $subject = new Subject($row['subject_id'], $row['subject_name']);
            return $subject;
        }
        return false;
    }

    public function getSubjectByName($subject_name)
    {
        $sql = "SELECT * FROM subjects WHERE subject_name='$subject_name'";
        $res = $this->pdo->query($sql);
        if ($row = $res->fetch()) {
            $subject = new Subject($row['subject_id'], $row['subject_name']);
            return $subject;
        }
        return false;
    }
    public function getAllSubjects()
    {
        $subjects = array();
        $sql = "select * from subjects";
        $res = $this->pdo->query($sql);
        $i = 0;
        while ($row = $res->fetch()) {
            $subjects[$i] = new Subject($row['subject_id'], $row['subject_name']);
            $i++;
        }
        return $subjects;
    }
}
