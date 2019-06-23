<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Online Testing System</title>
    <style>
        body,
        html {
            height: 50%
        }
    </style>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect("localhost", "root", "", "testing");
        if (mysqli_connect_error()) {
            echo "could not connect with db";
            die(mysqli_connect_error());
        }
        if (isset($_POST['cnic']) && isset($_POST['password']) && isset($_POST['role'])) {
            $cnic = $_POST['cnic'];
            $pas = $_POST['password'];
            $pass = md5($_POST['password']);
            $role =  $_POST['role'];
            if ($role == "Admin") {
                if ($cnic == "admin" && $pass == md5("admin")) {
                    $_SESSION['login_user'] = $cnic;
                    $_SESSION['role'] = $role;
                    setcookie("user", "valid", time() + (86400 * 30), "/");
                    header("Location: ./Admin/index.php");
                } else {
                    ?><script>
                        $(document).ready(function() {
                            $("#msg").addClass("alert alert-warning").html("Credentials not correct");
                        });
                    </script>
                <?php }
        } else {
            $coulmn_name = strtolower($role) . "_id";
            $tableName = strtolower($role) . "s";
            $sql = "select * from $tableName where cnic='$cnic' and password='$pass'";
            $result = mysqli_query($connection, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['login_user'] = $row["$coulmn_name"];
                $_SESSION['role'] = $role;
                header("Location: $role/index.php");
            } else { ?>
                    <script>
                        $(document).ready(function() {
                            console.log("SQL:" + "<?= $sql ?>");
                            console.log("SQL:" + "<?= $pas ?>");

                            $("#msg").addClass("alert alert-warning").html("Credentials not correct");
                        });
                    </script>
                <?php
            }
        }
    } else {
        echo "not set";
    }
}
?>

</head>


<style>
    #text {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: white;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
    }
</style>

<body>
    <?php
    if (isset($_SESSION['login_user']) && $_SESSION['role']) {

        // echo $_SESSION['login_user'];
        $role = $_SESSION['role'];
        header("Location: $role/index.php");
        // } else {
        //     echo "session expired";
        // }
        // if (isset($_COOKIE['user'])) {

        //     echo $_COOKIE['user'];
        // } else {
        //     echo "Cookie expired";
    }

    ?>

    <div class="container  pt-4 align-items-center h-100">
        <div class="card m-auto" style="width: 40%;">
            <h4 class="card-header text-center">Please Login</h4>
            <div class="card-body p-3">
                <form class="form-horizontal" action='' method="POST">
                    <div>
                        <label id="msg"></label>
                    </div>
                    <div class="control-group ">
                        <!-- cnic -->
                        <label class="control-label h5" for="cnic">Cnic</label>
                        <div class="controls">
                            <input type="text" id="cnic" name="cnic" required placeholder="" class="form-control input-xlarge" required>
                            <p id="usernameConfirmation"></p>
                        </div>
                    </div>

                    <div class="control-group ">
                        <!-- Password-->
                        <label class="control-label h5" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" required class="form-control input-xlarge">
                        </div>
                    </div>
                    <div class="control-group ">
                        <!-- Password-->
                        <label class="control-label h5 pt-2" for="role">Role</label>
                        <div class="controls">
                            <select class="form-control" required id="role" name="role">
                                <option value="Admin">Admin</option>
                                <option value="Student">Student</option>
                                <option value="Author">Author</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="control-group ">
                        <!-- Password-->
                        <input type="submit" id="submit" class="btn btn-success">

                    </div>
                </form>
            </div>
            <label>If you want to apply then click <a class="btn btn-success" href="applyOnline/index.php">here</a> </label>

        </div>
    </div>
</body>

</html>