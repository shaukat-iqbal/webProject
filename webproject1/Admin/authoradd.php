<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Author</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#cnic").on("change paste keyup", function() {
                $.post("../applyOnline/searchCnic.php", {
                    cnic: $("#cnic").val(),
                    role: "Admin"
                }, function(res) {
                    console.log(res);
                    if (res == "already registered") {
                        $("#cnicStatus").removeClass("d-none");
                        $("#cnicStatus").addClass("alert alert-warning").html("Cnic Already registered");
                        $("#submit").prop("disabled", true);

                    } else if (res == "not registered") {
                        $("#cnicStatus").addClass("d-none");
                        $("#submit").prop("disabled", false);

                    }

                });


            });
        });
    </script>
</head>

<body>
    <?php
    include_once("navigation.html");

    ?>

    <div class="container  pt-4">

        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Author Details</h4>

            <div class="card-body p-3">
                <form action="addaction.php" method="post">

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">CNIC</label>
                        <input type="text" name="cnic" class="form-control" id="cnic" placeholder="Without Dashes" required>
                        <p id="cnicStatus"></p>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="user@gmaili.com" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <!--        TODO: Add Other Fields here!-->
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject_id" class="form-control" required>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "testing");
                            if (!mysqli_connect_error()) {
                                $sql = "select * from subjects";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $subject_id = $row['subject_id'];
                                    $subject_name = $row['subject_name'];
                                    echo "<option value='$subject_id'>$subject_name</option>";
                                }
                            }
                            ?>


                        </select>
                    </div>

                    <button type="submit" id="submit" class="btn btn-primary">Add New Author</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>