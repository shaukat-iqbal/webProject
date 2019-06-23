<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script>
        $().ready(function() {
            $("#cnic").on("change paste keyup", function() {
                $.post("searchCnic.php", {
                    cnic: $("#cnic").val()
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

            $("#submit").click(function(event) {


                var obtainedInterMarks = parseFloat($("#obtainedInterMarks").val());
                var totalInterMarks = parseFloat($("#totalInterMarks").val());
                var per = (obtainedInterMarks / totalInterMarks) * 100;

                var obtainedMatricMarks = parseFloat($("#obtainedMatricMarks").val());
                var totalMatricMarks = parseFloat($("#totalMatricMarks").val());
                var per2 = (obtainedMatricMarks / totalMatricMarks) * 100;



                if (per < 60) {
                    $("#inter").addClass("alert alert-warning").html("Not eligible. Marks are low");
                    event.preventDefault();

                } else if (per2 < 60) {
                    $("#matric").addClass("alert alert-warning").html("Not eligible. Marks are low");
                    event.preventDefault();

                }

            });
        });
    </script>
</head>

<body>
    <div class="container  pt-4">

        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Registration Form</h4>

            <div class="card-body p-3">
                <form class=" well form-horizontal  w-100" action="register.php" method="post" id="contact_form">
                    <fieldset>
                        <!-- Form Name -->
                        <!-- <legend>

                            <h2 class="text-center h2 mt-5 pl-0"></h2>

                        </legend><br> -->

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="control-label">Full Name</label>
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <input name="name" placeholder="Shaukat Iqbal" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>


                        <!-- Text input-->

                        <div class="form-group">
                            <label class="control-label">Cnic</label>
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <input name="cnic" id="cnic" placeholder="3720396087251" class="form-control" type="text" required>


                                </div>
                                <p id="cnicStatus"></p>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="control-label">E-Mail</label>
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <input name="email" placeholder="timy@gmail.com" class="form-control" type="text" required>
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="control-label">Password</label>
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <input name="password" placeholder="*******" class="form-control" type="password" required>
                                </div>
                            </div>
                        </div>



                        <!-- Text input-->
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <textarea class="form-control" name="address" placeholder="Street 30 city islamabad"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <fieldset>
                                <legend>Matric Details</legend>
                                <table class="table">
                                    <thead>
                                        <th>
                                            Obtained Marks
                                        </th>
                                        <th>
                                            Total Marks
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control" type="number" id="obtainedMatricMarks" name="obtainedMatricMarks" placeholder="980" required />
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" id="totalMatricMarks" name="totalMatricMarks" placeholder="1100" required />

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p id="matric"></p>

                            </fieldset>
                            <fieldset>
                                <legend>Intermediate Details</legend>
                                <table class="table ">
                                    <thead>
                                        <th>
                                            Obtained Marks
                                        </th>
                                        <th>
                                            Total Marks
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control" type="number" id="obtainedInterMarks" name="obtainedInterMarks" placeholder="980" required />
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" id="totalInterMarks" name="totalInterMarks" placeholder="1100" required />

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p id="inter"></p>
                            </fieldset>
                        </div>
                        <!-- Select Basic -->
                        <!-- Button -->
                        <div class="form-group">
                            <label class="control-label"></label>
                            <div>
                                <input class="form-control px-5 btn btn-success " type="submit" id="submit">
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>





    </div>
    </div>

</body>

</html>