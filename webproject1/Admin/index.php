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
    <title>Authors| Online Testing System</title>


    <?php
    require_once("../Models/AuthorClass.php");
    $auth = new Author();
    $authArray = $auth->GetAllRecords();
    ?>

</head>

<body>

    <?php

    include_once("navigation.html");
    ?>
    <div class="container col-md-5">
        <table class="table">
            <th>Name</th>
            <th>Actions</th>
            <?php
            foreach ($authArray as $authObj) {
                ?>
                <tr>
                    <td>
                        <a href="authordetails.php?cnic=<?= $authObj->cnic ?>">
                            <?php
                            echo $authObj->name;
                            ?>
                        </a>
                    </td>

                    <td>
                        <a href="authoredit.php?cnic=<?= $authObj->cnic ?>">
                            <button type="button" class="btn btn-primary">Edit</button>
                        </a>
                        <a href="authordelete.php?cnic=<?= $authObj->cnic ?>">
                            <button type="button" class="btn btn-danger">Delete</button>
                        </a>
                        <a href="assignedSubjects.php?cnic=<?= $authObj->cnic ?>">
                            <button type="button" class="btn btn-danger">Assigned Subjects</button>
                        </a>
                    </td>


                </tr>
            <?php
        }
        ?>
        </table>
    </div>
</body>

</html>