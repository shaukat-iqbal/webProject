<?php
include("../Models/StudentClass.php");
if (isset($_POST['c'])) {
    $std = new Student();
    $student = $std->search($_POST['c']);

    if ($student == false) {
        echo "not registered";
        return;
    }
    if ($student->checkEnrollment()) {
        echo "already enrolled";
        return;
    }
    if ($student->enroll()) {
        $date = $_SESSION['test_date'];
        mail("$student->email", "Application confirmation", "Dear $student->name! \n Congratulations you have been successfully enrolled for"
            . "NTS test dated: $date", "From: shaukat.iqbal3001@gmail.com");
        echo "enrolled successfully";
        return;
    } else {

        echo false;
    }
} else {
    echo "No cnic given";
}
