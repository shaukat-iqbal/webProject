<?php
require_once("../config.php");

class Author
{
    public $name, $email, $cnic, $pass;
    private $pdo;


    public function __construct($name = null, $email = null, $cnic = null, $pass = null)

    {
        $connString = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $this->pdo = new PDO($connString, DBUSER, DBPASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->name = $name;
        $this->email = $email;
        $this->cnic = $cnic;
        $this->pass = $pass;
    }

    /*
     * Function takes Author attributes to insert into database
     * Function returns true on successful insertion, otherwise false
     */
    public function Insert($name, $email, $cnic, $pass)
    {
        // TODO: Write Definition to insert record into database
        $sql = "INSERT INTO authors (name, email, cnic, password) VALUES ('$name', '$email', '$cnic', '$pass')";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    public function GetAuthor($id)
    {
        // TODO: Write definition of this method
        $sql = "select * from authors WHERE author_id = $id";
        $result = $this->pdo->query($sql);
        $row = $result->fetch();
        return $row;
    }

    public function GetAuthorQuestions($authorid)
    {
        // TODO: Write definition of this method
        // 1 -- get subjectID 
        $sql = "select subject_id from assignedSubjects WHERE author_id = $authorid";
        $result = $this->pdo->query($sql);
        $row = $result->fetch();

        // 2 -- get questions from that subjectID
        $sql1 = "select * from questions where subject_id = " . $row['subject_id'];
        $result1 = $this->pdo->query($sql1);

        return $result1;
    }


    // /*
    //  * Function takes Author attributes to update record in database
    //  * Function returns true on successful update otherwise false
    //  */
    // public function Update($id, $EmpID, $FullName, $Designation)
    // {
    //     // TODO: Write Definition of this method
    //     $sql = "UPDATE Author SET EmpID = '$EmpID', FullName = '$FullName', Designation = '$Designation' WHERE id = $id";
    //     $count = $this->pdo->exec($sql);
    //     if ($count > 0)
    //         return true;
    //     return false;
    // }

    // /*
    //  * This function returns Author objects Array
    //  */
    // public function GetAllRecords()
    // {
    //     // $sql = "select * from Author";
    //     $sql = "SELECT Author.id,Author.EmpID, Author.FullName,Author.Designation, task.TaskDescription \n"
    //         . "FROM Author\n"
    //         . "INNER JOIN Authortasks ON Author.id=Authortasks.eID\n"
    //         . "INNER JOIN task ON Authortasks.tID=task.id";

    //     $result = $this->pdo->query($sql);
    //     $empArr = array();
    //     $i = 0;
    //     while ($row = $result->fetch()) {
    //         $empArr[$i] = new Author($row['id'], $row['EmpID'], $row['FullName'], $row['Designation'], $row['TaskDescription']);
    //         $i++;
    //     }
    //     return $empArr;
    // }



    // /*
    //  * Delete single Record
    //  */
    // public function Delete($id)
    // {
    //     // TODO: Write Definition of this method
    //     $sql = "DELETE from Author WHERE id = $id";
    //     $count = $this->pdo->exec($sql);
    //     if ($count > 0)
    //         return true;
    //     return false;
    // }
}
