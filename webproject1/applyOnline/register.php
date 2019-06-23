<?php
include_once("../Models/StudentClass.php");
include_once("../config.php");
$con = mysqli_connect("localhost", "root", "", "testing");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['obtainedMatricMarks']) && isset($_POST['obtainedInterMarks']) && isset($_POST['cnic'])) {
        $month = date('m');
        $year = date('y');
        $sql = "select * from  tests where test_date between '$year/$month/01' and '$year/$month/31'";
        $result = mysqli_query($con, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['test_id'] = $row['test_id'];
        }

        $std = new Student(null, $_POST['name'], $_POST['email'], $_POST['address'], $_POST['cnic'], $_POST['obtainedInterMarks'], $_POST['obtainedMatricMarks'], md5($_POST['password']));
        // echo $std->insert();
        if ($std->search($_POST['cnic'])) {
            echo "already registered";
            return;
        }
        if ($std->insert()) {
            if ($std->enroll()) {
                echo "successfully enrolled";
                header("Location: ../index.php");
            }
        }
    } else {
        echo "something is missing in form";
    }
}
