<?php
require_once("TestClass.php");
class Student
{
    public $id;
    public $name;
    public $email;
    public $address;
    public $cnic;
    public $inter;
    public $matric;
    public $password;
    public $pdo;

    public function __construct($id = null, $name = null, $email = null, $address = null, $cnic = null, $inter = null, $matric = null, $password = null)
    {

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->cnic = $cnic;
        $this->inter = $inter;
        $this->matric = $matric;
        $this->password = $password;
        $this->connect();
    }
    public function connect()
    {
        $connString = "mysql:host=localhost" . ";dbname=testing";
        $this->pdo = new PDO($connString, "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function insert()
    {
        $date = date('y/m/d');
        $sql = "insert into students (student_id,name,email,address,cnic,inter,matric,password,createdOrModifiedOn) 
    values(null,'$this->name', '$this->email', '$this->address', '$this->cnic', '$this->inter', '$this->matric', '$this->password','$date')";

        $count = $this->pdo->exec($sql);
        if ($count > 0) {

            return true;
        }
        return false;
    }
    public  function search($cnic)
    {
        $sql = "Select * from students where cnic='$cnic'";
        $result = $this->pdo->query($sql);
        if ($row = $result->fetch()) {
            $student = new Student($row['student_id'], $row['name'], $row['email'], $row['address'], $row['cnic'], $row['inter'], $row['matric'], $row['password']);
            return $student;
        } else {
            return false;
        }
    }

    public function checkEnrollment()
    {
        $month = date('m');
        $year = date('y');
        $query1 = "Select * from tests where test_date between '$year/$month/01' and '$year/$month/31'";
        $result = $this->pdo->query($query1);

        if ($row = $result->fetch()) {
            $test_id = $row['test_id'];

            $_SESSION['test_id'] = $row['test_id'];
            $_SESSION['test_date'] = $row['test_date'];

            $checkEntery = "Select * from enrolledStudents where test_id=$test_id and students_cnic LIKE '$this->cnic'";
            $result = $this->pdo->query($checkEntery);
            if ($row = $result->fetch()) {
                return true;
            }
            return false;
        } else {
            return "no test";
        }
    }

    public function checkEnrollmentById($student_id)
    {
        $test = new Test();
        $listOfAnnouncedTests = $test->getAnnoncedTests();
        $test_id = $listOfAnnouncedTests[0]->test_id;
        $sql = "select enrolledStudents.test_id  from enrolledStudents join students on students.cnic=enrolledStudents.students_cnic where students.student_id=$student_id and enrolledStudents.test_id=$test_id ";
        $result = $this->pdo->query($sql);

        if ($row = $result->fetch()) {

            $_SESSION['test_id'] = $row['test_id'];
            $_SESSION['test_date'] = $listOfAnnouncedTests[0]->test_date . " " . $listOfAnnouncedTests[0]->test_time;
            return true;
        } else {
            return false;
        }
    }
    public function enroll()
    {

        $test_id = $_SESSION['test_id'];
        $sql = "insert into enrolledStudents (test_id,students_cnic) values ('$test_id','$this->cnic')";
        $count = $this->pdo->exec($sql);
        if ($count > 0) {
            return true;
        } else {

            return false;
        }
    }

    public function searchByID($student_id)
    {
        $sql = "Select * from students where student_id='$student_id'";
        $result = $this->pdo->query($sql);
        if ($row = $result->fetch()) {
            $student = new Student($row['student_id'], $row['name'], $row['email'], $row['address'], $row['cnic'], $row['inter'], $row['matric'], $row['password']);
            return $student;
        } else {
            return false;
        }
    }
}
