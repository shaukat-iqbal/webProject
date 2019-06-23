<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Test</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        require_once("../Models/TestClass.php");
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == "done") { ?>
                <script>
                    $().ready(function() {

                        $("#msg").html("Successfully Added").addClass("alert alert-success");
                    });
                </script>
            <?php
        } else if ($status == "notEnough") {
            ?>
                <script>
                    $().ready(function() {

                        $("#msg").html("Not Enough Questions to create paper").addClass("alert alert-success");
                    });
                </script>
            <?php
        } else if ($status == "already") {
            ?>
                <script>
                    $().ready(function() {

                        $("#msg").html("Paper alreeady created").addClass("alert alert-success");
                    });
                </script>
            <?php
        }
    }
    $test = new Test();
    $testList = $test->getAnnoncedTests();
    if (count($testList) < 1) {
        echo "<div class='container'><h5 class='h5 alert-info w-50 p-5 text-center' >No test in current month announced yet</h5></div>";
        return;
    }
}
?>

</head>

<body>
    <?php
    require_once("navigation.html");    ?>
    <div class="container  pt-4">

        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Create Test</h4>
            <form action="addTestDetails.php" method="post">
                <div class="card-body p-3">
                    <p id="msg"></p>
                    <label class="mt-2 form-control" for="totalQuestions">Total questions:</label>
                    <input class="form-control" type="number" name="totalQuestions" id="totalQuestions" required>
                    <label class="mt-2 form-control" for="passingPercentage">Passing Percentage:</label>
                    <input class="form-control" type="number" name="passingPercentage" id="passingPercentage" required>


                    <label class="mt-2 form-control" for="testDate">Test on:</label>
                    <select name="test_id" class="form-control">
                        <?php
                        foreach ($testList as $test1) {
                            $test_date = $test1->test_date;
                            $test_id = $test1->test_id;

                            ?>
                            <option value='<?= $test_id ?>'><?= $test_date ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <input type="submit" value="Create Test" class="btn btn-success form-control w-25 mt-4">
            </form>
        </div>
    </div>
    </div>
</body>

</html>