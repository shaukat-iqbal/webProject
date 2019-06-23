<?php
require_once("../Models/TestClass.php");
if (isset($_POST['date']) && isset($_POST['time'])) {
    $test_date = $_POST['date'] . " " . $_POST['time'] . ":00";
    // echo $test_date;
    $test = new Test();
    $month = explode("-", $test_date)[1];
    $isFound = $test->getTestByDate($month);
    if (!$isFound) {
        if ($test->insert($test_date)) {
            echo "success";
        } else {
            echo "failure";
        }
    } else {
        echo "already";
    }
}
