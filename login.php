<?php
$conn = mysqli_connect("localhost", "root", "", "mydb");
session_start();
if (!empty($_SESSION['email'])) {
    header("location:index.php");
}


$conn = mysqli_connect("localhost", "root", "", "mydb");
   if (isset($_REQUEST['login'])) {
       $email = $_REQUEST['email'];
       $password = $_REQUEST['password'];
       echo $sql = "SELECT * from reg where email = '$email' and password = '$password';";
       $result = mysqli_query($conn, $sql);
       $total = mysqli_num_rows($result);
       

        if ($total > 0) {
            session_start();
            $_SESSION['email'] = $email;
           header("location:index.php");
       } else {
           echo "wrong Password";
       }
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Mima Technosoft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />


    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
   
</head>

<body>
    <div class="container mt-5">
        <div style="display:flex; justify-content:center;">
            <div class="col-md-6">
                <div class="card">
                    <div style="text-align: center" class="card-header">
                        <h3>login Form</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label>email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>

                            <div>
                            <div class="mb-3">
                                <label>password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">

                            </div>
                            <div style="text-align: center">
                            <button name="login" type="submit" class="btn btn-outline-primary">login</button>
                            <a href="ragistration.php" class="btn btn-outline-primary">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>