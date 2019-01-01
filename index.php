<head>


    <link rel="stylesheet" href="dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="dist/fonts/glyphicons-halflings-regular.svg"/>

    <script src="js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script></th
</head>
<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("location: header.php");
}




if (isset($_POST['submit'])) {
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];


    try {
        if (empty($admin_email)) {
            throw new Exception("Please Give email address");
        }
        if (empty($admin_password)) {
            throw new Exception("Please Give admin password");
        }

        //login
        //$sql = "SELECT * FROM tbl_admin WHERE admin_email = $admin_email AND admin_password= $admin_password";


        include_once './database.php';
        $statement = $db->prepare("SELECT * FROM admin WHERE email=? AND password=? LIMIT 1");
        $statement->execute(array($admin_email, $admin_password));
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $num = $statement->rowCount();

        if ($num == 1) {
            $_SESSION['admin'] = $row['admin_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];

            header("location: header.php");
        } else {
            throw new Exception("You've enterd invalid password!!!");
        }
    } catch (Exception $ex) {
        $error_message = $ex->getMessage();
    }
}
?>



<div class="login_area">
<?php
if (isset($error_message)) {

    echo "<div class='alert alert-danger'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            $error_message
</div>";
}
?>
    <div class="rakib">

        <div style="text-align:center">
            <h3>Admin Panel</h3></div>
        <form class="form-horizontal" action="" role="form" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" name="submit" class="btn btn-primary" value="Log In"/>
                </div>
            </div>
        </form>
    </div>



</div>

<?php include './footer.php'; ?>