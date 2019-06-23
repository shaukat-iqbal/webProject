<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assigned Subjects</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <?php
    require_once("../Models/AuthorClass.php");
    require_once("../Models/SubjectClass.php");
    $auth = new Author();
    $subj = new Subject();
    $allSubjects = $subj->getAllSubjects();
    $cnic = $_GET['cnic'];
    $author = $auth->GetSingleRecord($cnic);
    $subjectsList = $auth->getAssignedSubjects($author->author_id);

    ?>
    <script>
        $().ready(function() {
            $("#assign").click(function(event) {
                var subject_id = $("#subject_id").val();
                $.get("manageAssignedSubjects.php", {
                    action: "assign",
                    subject_id: subject_id,
                    author_id: <?= $author->author_id ?>
                }, function(res) {
                    // alert(res);
                    if (res == "assigned") {
                        window.location = "assignedSubjects.php?cnic=" + <?= $cnic ?>;
                    }
                });
            });

            $(".deAssign").click(function(event) {
                var subject_name = $(this).val();
                // alert(subject_name);
                $.get("manageAssignedSubjects.php", {
                    action: "remove",
                    subject_name: subject_name,
                    author_id: <?= $author->author_id ?>
                }, function(res) {
                    // alert(res);
                    if (res == "removed") {
                        window.location = "assignedSubjects.php?cnic=" + <?= $cnic ?>;
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
            <h4 class="card-header text-center">Subjects</h4>

            <div class="card-body p-3">

                <div class="form-group">

                    <?php
                    foreach ($subjectsList as $subject_name) {
                        ?>
                        <ul class="list-group">
                            <div class="row p-2">
                                <li class="col-md-10 list-group-item "><?= $subject_name ?></li>
                                <button class="deAssign btn btn-danger ml-2" value="<?= $subject_name ?>"><img src="../img/remove.png" width="30px" height="30px"></button>

                            </div>
                        </ul>
                    <?php
                }
                ?>
                </div>

                <div class="form-group">
                    <label for="subject_name">Assign new Subject</label>
                    <select id="subject_id" name="subject_id" class="form-control">
                        <?php
                        foreach ($allSubjects as $subject) {
                            if (gettype(array_search($subject->subject_name, $subjectsList)) == "boolean") {
                                ?>
                                <option class="list-group-item " value="<?= $subject->subject_id ?>"><?= $subject->subject_name ?></option>
                            <?php
                        }
                    }
                    ?>
                    </select>
                    <button id="assign" class="btn btn-info form-control w-25 mt-3">Assign</button>
                </div>

            </div>
        </div>
    </div>
</body>

</html>