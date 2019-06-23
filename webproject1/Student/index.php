<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Home| Online Testing System</title>
    <?php
    require_once("../Models/StudentClass.php");
    $std = new Student();
    $student = $std->searchByID($_SESSION['login_user']);

    ?>
</head>

<body>
    <?php
    require_once("navigation.html");
    ?>
    <div class="container pt-4">

        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Notification</h4>

            <div class="card-body p-3" style="height:25%">
                <?php

                if ($student->checkEnrollment()) {
                    $test_date = explode(" ", $_SESSION['test_date'])[0];
                    $time = explode(" ", $_SESSION['test_date'])[1];
                    echo "<h2 class='h2'> Dear $student->name</h2>";
                    echo "<h4> Your Test is on $test_date at $time sharp. </h4>";
                } else {
                    echo "<h2 class='h2'> Dear $student->name</h2>";
                    echo "<h4> You are not enrolled for the test please get yourself enrolled <a href='../applyOnline/index.php' class='btn btn-success'>Here</a> </h4>";
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>