<?php

unset($_SESSION['login_user']);
unset($_SESSION['index']);
unset($_SESSION['role']);
setcookie("user", null, -1);

header('location: index.php');
