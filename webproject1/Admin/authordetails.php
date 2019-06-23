<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Author Detail</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include_once("navigation.html");
    require_once("../Models/AuthorClass.php");

    $cnic = $_GET['cnic'];

    // TODO: Display Employee Details
    $auth = new Author();
    $authObject = $auth->GetSingleRecord($cnic);
    if ($authObject != null) {
        ?>
        <div class="container  pt-4">

            <div class="card m-auto" style="width: 50%;">
                <h4 class="card-header text-center">Author Details</h4>

                <div class="card-body p-3">


                    <div class="form-group  ">
                        <label for="name">Full Name</label>
                        <label name="name" class="form-control" id="name"><?= $authObject->name ?></label>
                    </div>
                    <div class="form-group  ">
                        <label for="name">CNIC</label>
                        <label name="cnic" class="form-control" id="cnic"><?= $authObject->cnic ?></label>
                    </div>
                    <div class="form-group  ">
                        <label for="name">Email</label>
                        <label name="email" class="form-control" id="email"><?= $authObject->email ?>
                    </div>
                    <div class="form-group  ">
                        <label for="name">Assgined Subjects</label>
                        <?php
                        foreach ($authObject->subject as $subject) { ?>
                            <ul class="list-group">
                                <li class="list-group-item"><?= $subject ?></li>
                            </ul>

                        <?php
                    }
                    ?>
                    </div>

                </div>
            </div>
        </div>


    <?php
}
?>
</body>

</html>