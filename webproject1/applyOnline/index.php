<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>
        <?php
        $con = mysqli_connect('localhost', 'root', '', 'testing');
        if (mysqli_connect_error()) {
            echo '<h1>Unfortunately we could not load page</h1>';
        } else {

            $month = date('m');
            $year = date('y');
            $sql = "select * from  tests where test_date between '$year/$month/01' and '$year/$month/31'";
            $result = mysqli_query($con, $sql);

            if ($row = mysqli_fetch_assoc($result)) {

                ?>
                $(document).ready(function() {

                    $("#disclaimer").removeClass("d-none");
                    $('#yes').on('click', function() {
                        $("#registered").removeClass("d-none");
                        $("#question").addClass("d-none");
                        $('button').addClass('d-none');
                        $('#submit').removeClass('d-none');
                        $('#login').removeClass('d-none');
                    });
                    $('#no').on('click', function() {
                        window.location = "form.php";

                    });
                    $("#submit").on('click', function() {
                        var cnic = $("#registeredCnic").val();
                        console.log(cnic);
                        $.post('enrollStudent.php', {
                            c: cnic
                        }, function(res) {
                            console.log(res);
                            if (res == "not registered") {
                                alert("Cnic is not registered we are redirecting to form");
                                window.location = "form.php";
                            } else if (res == "already enrolled") {
                                $("#msg").html("Dear Student You are already enrolled for upcoming test");
                                $("#msg").addClass("alert alert-info");
                            } else if (res == "enrolled successfully") {
                                $("#msg").html("Congratulations!  you have been successfully enrolled for NTS test.\n We have sent you details through email please check your inbox");
                                $("#msg").addClass("alert alert-success");
                            } else {
                                $("#msg").html("Something went wrong!");
                                $("#msg").addClass("alert alert-success");
                            }


                        });
                    })


                });

            <?php
        } else { ?>
                $(document).ready(function() {
                    $("#msg").html("Dear Student There is no test annouced yet. Kindly visit later");

                });
            <?php
        }
    }

    ?>
    </script>
    <style>
        html,
        body {
            height: 50%;
        }

        #parent>* {
            margin: 0px 10px;
        }
    </style>
</head>

<body>
    <!-- <div class="container  h-100 row align-items-center">
        <p id="msg"></p>
    </div> -->
    <div class="container pt-4">

        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Disclaimer</h4>

            <div class="card-body p-3">
                <p id="msg"></p>
                <div class="row p-3 border-bottom">
                    <h4 class="h4" id="question">
                        Have you appeared in the test before?

                    </h4>


                    <div class="form-group d-none" id="registered">
                        <label class="control-label">Please Enter CNIC:</label>
                        <input id="registeredCnic" name="registeredCnic" placeholder="e.g:3720396087251" class="form-control" type="text" required>

                    </div>
                </div>
                <div class="row p-3" id="parent">
                    <button type="button" class="btn btn-secondary" id="no">No</button>
                    <button type="button" class="btn btn-primary" id="yes">Yes</button>
                    <button type="button" class="btn btn-primary d-none" id="submit">Submit</button>
                    <a href="../index.php" type="button" class="btn btn-primary d-none" id="login">Login</a>

                </div>
            </div>
        </div>
    </div>

</body>

</html>