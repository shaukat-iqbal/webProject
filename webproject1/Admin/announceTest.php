<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <title>Test Announcement</title>
    <script>
        $(document).ready(function() {
            var date = new Date();
            var month = date.getMonth() + 1;
            if (month < 10) {
                month = "0" + month;
            }
            console.log(date.getFullYear() + "-" + month + "-" + date.getDate());
            var minDate = date.getFullYear() + "-" + month + "-" + date.getDate();
            $("#test_date").attr("min", minDate);
            $(":submit").click(function(e) {
                var testDate = $("input[name=test_date]").val();
                var testTime = $("input[name=test_time]").val();
                $.post("setTestDate.php", {
                    date: testDate,
                    time: testTime
                }, function(res) {

                    // console.log(res);
                    // // alert(res);
                    if (res == "success") {
                        $("#msg").html("New test has been added to the system. Kindly now prepare the paper for it").addClass("alert alert-success");
                    } else if (res == "already") {
                        $("#msg").html("The test in given month is already announced").addClass("alert alert-success");

                    } else {
                        $("#msg").html("Sorry: Please try again.").addClass("alert alert-success");

                    }

                });

            });
        });
    </script>

</head>

<body>
    <?php
    require_once("navigation.html");
    ?>
    <div class="container  pt-4">

        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Test Announcement</h4>

            <div class="card-body p-3">
                <p id="msg"></p>
                <label class="mt-2 form-control" for="testDate">Test Date</label>
                <input class="form-control date" type="date" name="test_date" min="" id="test_date" required>
                <label class="mt-2 form-control" for="testDate">Time</label>

                <input class="form-control date" type="time" name="test_time" id="test_time" required>

                <input type="submit" id="submit" value="Submit" class="btn btn-danger">
            </div>
        </div>
    </div>

</body>

</html>