<?php
require_once("TestClass.php");
require_once("ResultClass.php");
// require_once("config.php");


class Question
{
    public $qID, $subjectID, $description, $option1, $option2, $option3, $answer;
    private $pdo;


    public function __construct($subjectID = null, $qID = null, $description = null, $option1 = null, $option2 = null, $option3 = null, $answer = null)

    {
        $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $this->pdo = new PDO($connString, DBUSER, DBPASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->qID = $qID;
        $this->subjectID = $subjectID;
        $this->description = $description;
        $this->option1 = $option1;
        $this->option2 = $option2;
        $this->option3 = $option3;
        $this->answer = $answer;
    }

    /*
     * Function takes Question attributes to insert into database
     * Function returns true on successful insertion, otherwise false
     */
    public function Insert($description, $subjectID, $option1, $option2, $option3, $answer)
    {
        // TODO: Write Definition to insert record into database
        $sql = "INSERT INTO questions (description , option1, option2, option3, answer, subject_id) VALUES ('$description', '$option1','$option2','$option3','$answer', $subjectID)";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    public function GetSingleRecord($question_id)
    {
        // TODO: Write definition of this method
        $sql = "select * from questions WHERE question_id = $question_id";
        $result = $this->pdo->query($sql);
        $row = $result->fetch();
        return $row;
    }



    public function Update($question_id, $description, $option1, $option2, $option3, $answer, $subject_id)
    {
        $sql = "UPDATE questions SET description = '$description', option1 = '$option1', option2 = '$option2', option3 = '$option3', answer = '$answer' WHERE question_id = $question_id";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    /*
     * Delete single Record
     */
    public function Delete($id)
    {
        // TODO: Write Definition of this method
        $sql = "DELETE from questions WHERE question_id = $id";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    public function getPaperQuestions($test_id)
    {
        # code...
        $questionsList = array();

        $sql = "select questions.question_id,questions.description,questions.option1,questions.option2,questions.option3,questions.answer,questions.subject_id
         from papers 
         join questions 
         on questions.question_id=papers.question_id 
         where papers.test_id=$test_id";
        $result = $this->pdo->query($sql);
        $i = 0;
        while ($row = $result->fetch()) {
            $question_id = $row['question_id'];
            $description = $row['description'];
            $option1 = $row['option1'];
            $option2 = $row['option2'];
            $option3 = $row['option3'];
            $answer = $row['answer'];
            $subject_id = $row['subject_id'];
            $questionsList[$i] = new Question($subject_id, $question_id, $description, $option1, $option2, $option3, $answer);
            $i++;
        }
        return $questionsList;
    }

    public function getAllQuestions()
    {
        $qsnList = array();
        $i = 0;
        $sql = "select * from questions";
        $res = $this->pdo->query($sql);
        while ($row = $res->fetch()) {

            $question_id = $row['question_id'];
            $description = $row['description'];
            $option1 = $row['option1'];
            $option2 = $row['option2'];
            $option3 = $row['option3'];
            $answer = $row['answer'];
            $subject_id = $row['subject_id'];
            $qsnList[$i] = new Question($subject_id, $question_id, $description, $option1, $option2, $option3, $answer);
            $i++;
        }
        return $qsnList;
    }

    public function insertResponse($student_id, $test_id, $question_id, $answer)
    {
        $sql = "INSERT INTO studentanswers(student_id, test_id, question_id, answer) VALUES ($student_id,$test_id,$question_id,'$answer');";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }


    // /*
    //  * This function returns Question objects Array
    //  */
    // public function GetAllRecords()
    // {
    //     // $sql = "select * from Question";
    //     $sql = "SELECT Question.id,Question.EmpID, Question.FullName,Question.Designation, task.TaskDescription \n"
    //         . "FROM Question\n"
    //         . "INNER JOIN Questiontasks ON Question.id=Questiontasks.eID\n"
    //         . "INNER JOIN task ON Questiontasks.tID=task.id";

    //     $result = $this->pdo->query($sql);
    //     $empArr = array();
    //     $i = 0;
    //     while ($row = $result->fetch()) {
    //         $empArr[$i] = new Question($row['id'], $row['EmpID'], $row['FullName'], $row['Designation'], $row['TaskDescription']);
    //         $i++;
    //     }
    //     return $empArr;
    // }



}
