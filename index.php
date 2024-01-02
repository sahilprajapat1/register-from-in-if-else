<?php

session_start();
// $conn = mysqli_connect("localhost", "root", "", "mydb");
$email = $_SESSION['email'];
if (empty($_SESSION['email'])) {
    header("location:login.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        b {
            font-family: "Sofia", sans-serif;
            font-size: 20px;
        }

        img {
            border: 1px solid #96ad3a;
            border-radius: 10px;
            padding: 5px;

        }

        img:hover {
            box-shadow: 0 0 5px 1px rgba(188, 217, 73);
        }

        h6:hover {
            box-shadow: 0 0 100px 1px rgba(200, 176, 73);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <a class="nav-link" href="index.php">
                    Dashbord
                </a>
                <a class="nav-link" href="index.php">
                    Contect
                </a>
                <a class="nav-link" href="index.php">
                    About
                </a>



            </ul>

            <?php
            $query = "SELECT * from reg where email = '$email';";
            $res = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($res);
            $name = $row['name'];

            ?>
            <div>
                <button type="button" class="btn header-item user text-start d-flex align-items-center" data-bs-toggle="dropdown">
                    <img class="rounded-circle" src="<?php echo $row['Image']; ?>" alt="" width="70px" height=50px;>
                    </ul>>
                </button>
                <div class="dropdown-menu dropdown-menu-end colspan=2">
                    <b> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name; ?></b>
                    <a class="dropdown-item" href="logouts.php"> Logout</a>
                </div>
            </div>

        </div>
    </nav><br>











    
   
</body>

</html>