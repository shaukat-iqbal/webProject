<?php
require_once("../config.php");

class Author
{
    public $author_id, $name, $cnic, $email, $password, $subject;
    private $pdo;


    public function __construct($author_id = null, $name = null, $cnic = null, $email = null, $password = null, $subject = NULL)
    {
        $connString = "mysql:host=localhost;dbname=testing";
        $this->pdo = new PDO($connString, DBUSER, DBPASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($author_id != null) {
            $this->author_id = $author_id;
            $this->name = $name;
            $this->cnic = $cnic;
            $this->email = $email;
            $this->password = $password;
            $this->subject = $subject;
        }
    }

    /*
     * Function takes Author attributes to insert into database
     * Function returns true on successful insertion, otherwise false
     */
    public function Insert($name, $cnic, $email, $password, $subject_id)
    {
        // TODO: Write Definition to insert record into database
        $pass = md5($password);
        $sql = "INSERT INTO authors (author_id, name, email, cnic, password) VALUES (NULL, '$name', '$email', '$cnic', '$pass')";
        $count = $this->pdo->exec($sql);
        $author_id = $this->pdo->lastInsertId();

        if ($count > 0) {
            // need to assign subject to athor
            if ($this->assignSubject($subject_id, $author_id))
                return true;
        }
        return false;
    }

    public function assignSubject($subject_id, $author_id)
    {
        $sql = "INSERT INTO assignedsubjects (subject_id,author_id) values ('$subject_id', '$author_id')";
        $count = $this->pdo->exec($sql);

        if ($count > 0) {
            return true;
        }
        return false;
    }

    public function deAssignSubject($subject_id, $author_id)
    {
        $sql = "delete from assignedsubjects where subject_id='$subject_id' and author_id='$author_id'";
        $count = $this->pdo->exec($sql);

        if ($count > 0) {
            return true;
        }
        return false;
    }

    /*
     * Function takes Author attributes to update record in database
     * Function returns true on successful update otherwise false
     */
    public function Update($name, $cnic, $email, $password)
    {
        $pass = md5($password);
        // TODO: Write Definition of this method
        $sql = "UPDATE authors SET name = '$name', email = '$email', password= '$pass' WHERE cnic = '$cnic'";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }

    /*
     * This function returns author objects Array
     */
    public function GetAllRecords()
    {
        $sql = "select * from authors";
        // $sql = "SELECT author.author_id,author.name, author.cnic,author.email, task.password, task.subject \n"
        //     . "FROM author\n"
        //     . "INNER JOIN authortasks ON author.author_id=authortasks.eauthor_id\n"
        //     . "INNER JOIN task ON authortasks.tauthor_id=task.author_id";

        $result = $this->pdo->query($sql);
        $autharr = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $autharr[$i] = new Author($row['author_id'], $row['name'], $row['cnic'], $row['email'], $row['password']);
            $i++;
        }
        return $autharr;
    }

    public  function search($cnic)
    {
        $sql = "Select * from authors where cnic='$cnic'";
        $result = $this->pdo->query($sql);
        if ($row = $result->fetch()) {
            $author = new Author($row['author_id'], $row['name'], $row['cnic'], $row['email'], $row['password']);
            return $author;
        } else {
            return false;
        }
    }
    /*
     * This function returns single Object of this class
     * Search Criteria: author_id
     */
    public function GetSingleRecord($cnic)
    {
        // TODO: Write definition of this method
        $sql = "select * from authors where cnic = '$cnic'";
        $result = $this->pdo->query($sql);
        $authObj = null;
        while ($row = $result->fetch()) {

            $authObj = new Author($row['author_id'], $row['name'], $row['cnic'], $row['email'], $row['password'], $this->getAssignedSubjects($row['author_id']));
        }
        return $authObj;
    }

    public function getAssignedSubjects($author_id)
    {
        $subjArr = array();
        $i = 0;
        $sql = "select subjects.subject_name 
        from assignedsubjects
        join subjects on subjects.subject_id=assignedsubjects.subject_id
         WHERE assignedsubjects.author_id = '$author_id'";
        $res = $this->pdo->query($sql);
        while ($row = $res->fetch()) {
            $subjArr[$i] = $row['subject_name'];
            $i++;
        }
        return $subjArr;
    }
    public function getAssignedSubjectsByID($author_id)
    {
        $subjArr = array();
        $i = 0;
        $sql = "select subjects.subject_name subjects.subject_id
        from assignedsubjects
        join subjects on subjects.subject_id=assignedsubjects.subject_id
         WHERE assignedsubjects.author_id = '$author_id'";
        $res = $this->pdo->query($sql);
        while ($row = $res->fetch()) {
            $subjArr[$i] = new Subject($row['subject_id'], $row['subject_name']);
            $i++;
        }
        return $subjArr;
    }
    // public function GetAuthorTasks($author_id)
    // {
    //     // TODO: Write definition of this method
    //     $sql = "SELECT author.author_id,author.name, author.cnic,author.email, task.password, task.subject \n"
    //         . "FROM authors\n"
    //         . "INNER JOIN authortasks ON author.author_id=authortasks.eauthor_id\n"
    //         . "INNER JOIN task ON authortasks.tauthor_id=task.author_id where author.author_id=" . $author_id;
    //     $result = $this->pdo->query($sql);
    //     $empObj = null;
    //     $i = 0;
    //     while ($row = $result->fetch()) {
    //         $empObj[$i] = new Author($row['author_id'], $row['name'], $row['cnic'], $row['email'], $row['password'], $row['subject']);
    //         $i++;
    //     }
    //     return $empObj;
    // }
    /*
     * Delete single Record
     */
    public function Delete($cnic)
    {
        // TODO: Write Definition of this method
        $sql = "DELETE from authors WHERE cnic = $cnic";
        $count = $this->pdo->exec($sql);
        if ($count > 0)
            return true;
        return false;
    }
}
