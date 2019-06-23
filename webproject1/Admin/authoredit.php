<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Author Profile</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "testing");
    if (mysqli_connect_error()) {
        echo "could not connect";
    }
    require_once("../Models/AuthorClass.php");
    $cnic = $email = $name = $password = '';
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // TODO: Write Get Action to display record and fill the fields for editing
        $cnic = $_GET['cnic'];
        $auth = new Author();
        $authObject = $auth->GetSingleRecord($cnic);
        if ($authObject != null) {
            $author_id = $authObject->author_id;
            $email = $authObject->email;
            $name = $authObject->name;
            $password = $authObject->password;
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // TODO: Write code to Update records based on posted back fields
        $auth = new Author();
        if ($auth->Update($_POST['name'], $_POST['cnic'], $_POST['email'], $_POST['password'])) {
            echo "success";
            header("Location: index.php");
        }
    }
    ?>
    <!-- <script>
        $(document).ready(function() {
            // $("#remove").on("click", function() {
            //     $.post("./manageAssignedSubjects.php", {
            //         author_id: "<?= $authObject->author_id ?>",
            //         action: "remove",
            //         subject_name: "Physics"

            //     }, function(res) {
            //         console.log(res);
            //         if (res == "success") {

            //         }
            //     });
            // });
            $("#remove").click(function(event) {
                var idOfDiv = $(this).val();
                console.log(idOfDiv);
                $("#abc").addClass("d-none");

            });
            $("#add").click(function(e) {
                e.preventDefault();
                var di = `<div class =' mx-1 row form-group' id='abc'>
                    <input type = 'text'value = 'abc' class = 'list-group-item col-md-9 mr-3 disabled' >
                    <button id='remove' class = ' col-md-2' value="abc"><img src = '../img/remove.png'  alt = 'icon'  width = '20px'  height = '20px' ></button>
                    
                    </div>`;
                //<a href = 'manageAssignedSubjects.php?author_id=abc&subject_name=abc&action=remove&cnic=abc' class = 'btn btn-danger list-group-item ml-1 col-md-2' > <img src = '../img/remove.png'  alt = 'icon'  width = '20px'  height = '20px' > </a>
                $(".subjectDiv").after(di);

                console.log(" add is clicked");

            });

        });
    </script> -->
</head>

<body>
    <?php
    include_once("navigation.html");
    ?>
    <div class="container  pt-4">
        <div class="card m-auto" style="width: 50%;">
            <h4 class="card-header text-center">Update Author</h4>

            <div class="card-body p-3">
                <form action="" method="post">
                    <input type="hidden" name="cnic" value="<?= $cnic ?>">

                    <div class="form-group">
                        <label for="name">Author Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" value="<?= $name ?>">
                    </div>
                    <!--        TODO: Add Other Fields here!-->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= $email ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password" value="<?= $password ?>">
                    </div>
                    <div class="form-group ">
                        <label for="name">Assgined Subjects</label>
                        <ul class="list-group">
                            <?php
                            foreach ($authObject->subject as $subject) {
                                $_SESSION['subjects'] = $authObject->subject;
                                ?>

                                <input type="text" id="<?= $subject ?>" value="<?= $subject ?>" class="list-group-item  disabled">



                            <?php
                        }
                        ?>


                        </ul>

                    </div>
                    <!-- <div class="form-group">
                        <form action="manageAssignedSubjects.php" id="inner" method="post">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="author_id" value="<?= $author_id ?>">
                            <input type="hidden" name="cnic" value="<?= $cnic ?>">
                            <label for="subject">Subject</label>
                            <div class="mx-1 row form-group">
                                <?php
                                print_r($_SESSION["subjects"]);

                                ?>
                                <select id="subject" name="subject_id" class="form-control col-md-9 mr-3 " required>
                                    <?php

                                    $sql = "select * from subjects";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $subject_id = $row['subject_id'];
                                        $subject_name = $row['subject_name'];
                                        // echo $subject_name . "is subject name";

                                        // if ($subject_name != 'Physics') {
                                        if (gettype(array_search($subject_name, $_SESSION['subjects'])) == "boolean") {

                                            echo "<option value='$subject_id'>$subject_name</option>";
                                        }
                                    }

                                    ?>


                                </select>


                                <button id="add" class="btn btn-primary">Add</button>
                                <a href="manageAssignedSubjects.php?author_id=<?= $author_id ?>&subject_name=" ++"&action=add&cnic=<?= $cnic ?>" class="btn btn-danger list-group-item ml-1 col-md-2"><img src="../img/add.png" alt="icon" width="20px" height="20px"></a>

                            </div>
                        </form>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>