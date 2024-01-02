<?php
// $conn = mysqli_connect("localhost", "root", "", "mydb");
// session_start();
// if (!empty($_SESSION['email'])) {
//     header("location:index.php");
// }


$conn = mysqli_connect("localhost", "root", "", "mydb");

if (isset($_REQUEST['submit'])) {
    $name = $_REQUEST['name'];
    $image_file = $_FILES["image"]["name"];
    $i = 0;
    foreach ($image_file as $image_file) {
        $img_tmp = $_FILES["image"]["tmp_name"][$i];
        $path = "images/" . $image_file;
        move_uploaded_file($img_tmp, $path);
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $gender = $_REQUEST['gender'];
        $city = $_REQUEST['city'];
        $password = $_REQUEST['password'];
        $insert = "INSERT into reg  (`name`,`Image`,email,phone,gender,city,`password`) values('$name','$path','$email','$phone','$gender','$city','$password')";
        mysqli_query($conn, $insert);
        $i++;
        header("location:ragistration.php");
    }
}
if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];
    $query = "SELECT * FROM reg where id='$id';";
    $result = mysqli_query($conn, $query);
    $path = mysqli_fetch_array($result);
    unlink($path['Image']);
    $sql = "DELETE FROM reg WHERE id='$id'";
    mysqli_query($conn, $sql);
    header('location:ragistration.php');
}
if (isset($_REQUEST['btndel_id'])) {
    $id = $_REQUEST['chk'];

    foreach ($id as $chk) {
        $select = "SELECT * from reg where id = '$chk';";
        $res = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($res);
        $to_del = $row['Image'];
        unlink($to_del);
        $sql = "DELETE from reg where id='$chk'";
        mysqli_query($conn, $sql);
        header('location:ragistration.php');
    }
}


if (isset($_REQUEST['uid'])) {
    $id = $_REQUEST['uid'];
    $fetch_data = "select * from reg where id='$id'";
    $fetch_data_executed = mysqli_query($conn, $fetch_data);
    $fetch_uddate = mysqli_fetch_array($fetch_data_executed);
}
if (isset($_REQUEST['update'])) {
    $id = $_REQUEST['hidden_id'];
    $name = $_REQUEST['name'];
    $image_file = $_FILES["image"]["name"];

    if (empty($image_file)) {

        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $gender = $_REQUEST['gender'];
        $city = $_REQUEST['city'];
        $password = $_REQUEST['password'];

        $update = "UPDATE reg SET name='$name', email='$email', phone='$phone', gender='$gender', city='$city', password='$password' WHERE id='$id';";
        mysqli_query($conn, $update);
        header("location: ragistration.php");
    } else {
        $img_tmp = $_FILES["image"]["tmp_name"];
        $path = "images/" . $image_file;

        if (move_uploaded_file($img_tmp, $path)) {
            $query = "SELECT * FROM reg WHERE id='$id';";
            $result = mysqli_query($conn, $query);
            $d = mysqli_fetch_array($result);
            unlink($d['Image']);
            $email = $_REQUEST['email'];
            $phone = $_REQUEST['phone'];
            $gender = $_REQUEST['gender'];
            $city = $_REQUEST['city'];
            $password = $_REQUEST['password'];
            $update = "UPDATE reg SET name='$name', Image='$path', email='$email', phone='$phone', gender='$gender', city='$city', password='$password' WHERE id='$id';";
            mysqli_query($conn, $update);

            header("location: ragistration.php");
      
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <div class="container mt-5">
        <div style="display:flex; justify-content:center;">
            <div class="col-md-6">

                <div class="card">
                    <div style="text-align: center" class="card-header">
                        <h3>Registration Form </h3>

                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <?php if (isset($_REQUEST['uid'])) { ?>
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter name....." id="name" value='<?php echo $fetch_uddate['name']; ?>'>
                                    <input type="hidden" value="<?php echo $fetch_uddate['id']; ?>" name="hidden_id">
                                <?php } else { ?>

                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                <?php } ?>
                            </div>

                            <div class="mb-12">
                                <?php if (isset($_REQUEST['uid'])) { ?>
                                    <label>Profile</label>
                                    <input type='file' name='image' id="myfile">
                                    <img src="<?php echo $fetch_uddate['Image']; ?>" width="100px" height=50px;>
                                <?php } else { ?>
                                    <label>Profile</label>
                                    <input type="file" class="form-control" id="myfile" name="image[]" multiple />
                                <?php } ?>


                                <div class="mb-3">
                                    <?php if (isset($_REQUEST['uid'])) { ?>
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email" placeholder="Enter email....." id="name" value='<?php echo $fetch_uddate['email']; ?>'>
                                    <?php } else { ?>
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                    <?php } ?>
                                </div>
                                <div class="mb-3">
                                    <?php if (isset($_REQUEST['uid'])) { ?>
                                        <label>Phone NO:</label>
                                        <input class="form-control" type="text" name="phone" placeholder="Enter phone....." id="phone" value='<?php echo $fetch_uddate['phone']; ?>'>
                                    <?php } else { ?>
                                        <label>Phone NO:</label>
                                        <input type="number" class="form-control" id="number" name="phone" placeholder="Enter Number">
                                    <?php } ?>
                                </div>



                                <div class="mb-3">
                                    <?php if (isset($_REQUEST['uid'])) { ?>
                                        <label>gender</label>
                                        <label>Male <input type="radio" name="gender" value="male" <?php echo $fetch_uddate['gender']  == 'male' ? 'checked' : ''; ?> /></label>
                                        <label>female <input type="radio" name="gender" value="female" <?php echo $fetch_uddate['gender']  == 'female' ? 'checked' : ''; ?> /></label>
                                        <label>other <input type="radio" name="gender" value="other" <?php echo $fetch_uddate['gender']  == 'other' ? 'checked' : ''; ?> /></label>


                                    <?php } else { ?>

                                        <label>Gender:</label>
                                        <label>Male <input type="radio" name="gender" value="male"></label>
                                        <label>female <input type="radio" name="gender" value="female"></label>
                                        <label>other <input type="radio" name="gender" value="other"></label>
                                    <?php } ?>
                                </div>

                                <div class="mb-3">
                                    <?php if (isset($_REQUEST['uid'])) { ?>

                                        <label>city</label>
                                        <select name="city">
                                            <option value="Surat" <?php echo $fetch_uddate['city'] == 'Surat' ? 'selected' : ''; ?>>Surat</option>
                                            <option value="Vapi" <?php echo $fetch_uddate['city'] == 'Vapi' ? 'selected' : ''; ?>>vapi</option>
                                        </select>
                                    <?php } else { ?>
                                        <label>City</label>
                                        <select name="city">
                                            <option>select</option>
                                            <option value="Surat">Surat</option>
                                            <option value="Vapi">vapi</option>
                                        </select>
                                    <?php } ?>

                                </div>
                                <div class="mb-3">
                                    <?php if (isset($_REQUEST['uid'])) { ?>
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Enter password....." id="password" value='<?php echo $fetch_uddate['password']; ?>'>
                                    <?php } else { ?>
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                    <?php } ?>
                                </div>

                                <div style="text-align: center">
                                    <?php if (isset($_REQUEST['uid'])) { ?>
                                        <button class="btn btn-outline-primary" name="update" type="submit">update</button>
                                    <?php } else { ?>
                                        <button name="submit" type="submit" class="btn btn-outline-primary">Submit</button>
                                    <?php } ?>
                                    <a href="login.php" class="btn btn-outline-primary">login</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div>

        <div>
            <form action="ragistration.php" method="POST">


                <input type="text" name="search">
                <input type="submit" name="search1" value="Search" />
            </form>
        </div><br>
        <div>
            <form method="POST">
                <div class="card-body" style="<?php echo (empty($_REQUEST['search'])) ? '' : 'display:none' ?>">

                    <table class="table table-bordered  table-hover mb-0">
                        <tr>

                            <th>Select</th>
                            <th>Id</th>
                            <th>NAME</th>
                            <th>PROFILE</th>
                            <th>EMAIL </th>
                            <th>GENDER</th>
                            <th>CITY</th>
                            <th>PHONE NO</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $insert = "SELECT * from reg;";
                            $result = mysqli_query($conn, $insert);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><input type="checkbox" value="<?php echo $row['id'] ?>" name="chk[]"></td>
                                    <td><?php echo $row['id'];  ?> </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td> <img src="<?php echo $row['Image']; ?>" alt="" width="100px" height=70px;> </td>
                                    <td><?php echo $row['email']; ?></td>

                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td>

                                        <div class="col-12">
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap gap-1">
                                                    <a href="ragistration.php?uid=<?php echo $row['id']; ?>" type="button" class="btn btn-success waves-effect waves-light">UPDATE</a>

                                                    <a href="ragistration.php?delete_id=<?php echo $row['id']; ?>" type="button" class="btn btn-danger waves-effect waves-light">
                                                        Delete</a>
                                                </div>

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                        <td>
                            <input type="submit" value="Delete" name="btndel_id" class="btn btn-danger waves-effect waves-light">
                        </td>

                    </table>
                    <br>
                </div>
        </div>
        <div class="card-body" style="<?php echo (!empty($_REQUEST['search'])) ? '' : 'display:none' ?>">
            <?php
            $search = $_REQUEST['search'];
            $query1 = "SELECT * FROM reg where `name` LIKE '%$search%';";
            $res = mysqli_query($conn, $query1);
            ?>
            <div class="table-responsive">
                <table class="table table-bordered  table-hover mb-0">
                    <tr>
                        <th>Select</th>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>Image</th>
                        <th>EMAIL</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>City</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($res)) { ?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo $row['id'] ?>" name="chk[]"></td>
                                <td><?php echo $row['id'];  ?> </td>
                                <td><?php echo $row['name'] ?></td>
                                <td><img src="<?php echo $row['Image']; ?>" alt="" width="100px" height=70px;></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['gender'] ?></td>
                                <td><?php echo $row['city'] ?></td>
                                <td>
                                    <div class="col-12">
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap gap-1">
                                                <a href="ragistration.php?uid=<?php echo $row['id']; ?>" type="button" class="btn btn-success waves-effect waves-light">UPDATE</a>

                                                <a href="ragistration.php?delete_id=<?php echo $row['id']; ?>" type="button" class="btn btn-danger waves-effect waves-light">
                                                    Delete</a>
                                            </div>

                                        </div>
                                    </div>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <td>
                        <input type="submit" value="Delete" name="btndel_id" class="btn btn-danger waves-effect waves-light">
                    </td>
                    <td>
                        <a href="ragistration.php" class="btn btn-outline-primary">Back</a>
                    </td>
                </table>
                <br>
            </div>
        </div>
        </form>
    </div>
    </div>
</body>

</html>
