<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location:index.php");
}
include_once './header.php';


include_once './database.php';
if ($_SESSION['admin'] == "admin") {
    
} else {
    
}
?>
<?php
include_once './header.php';
include_once './database.php';
if (!isset($_REQUEST['id'])) {
    header("location: edit_employee.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['form_employee'])) {
    try {

        if (empty($_POST['name'])) {
            throw new Exception("Employee Name can not be empty.");
        }



        $statement = $db->prepare("UPDATE employee SET name=? , designation=? , department=? , phone=? , address=?, faculty=?  WHERE id=?");
        $statement->execute(array($_POST['name'], $_POST['designation'], $_POST['department'], $_POST['phone'], $_POST['address'], $_POST['faculty'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = "Employee Information updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM employee WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name = $row['name'];
    $designation = $row['designation'];
    $department = $row['department'];
    $phone = $row['phone'];

    $address = $row['address'];

    $faculty = $row['faculty'];
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <table class="edit_form">
        <?php
        if (isset($error_message)) {
            echo $error_message;
        }
        if (isset($success_message)) {
            echo $success_message;
        }
        ?>
        <th width="5%">Employee Name</th>
        <tr><td><input style="width: 400px;" type="text" name="name" value="<?php echo $name; ?>"> </td></tr>
        <th width="5%">Employee Designation</th>
        <tr><td><textarea cols="47" rows="10" type="text" name="designation"><?php echo $designation; ?></textarea></td></tr>
        <th width="5%">Employee Department</th>
        <tr><td><input style="width: 400px;" type="text" name="department" value="<?php echo $department; ?>"> </td></tr>
        <th width="5%">Employee Number</th>
        <tr><td><input style="width: 400px;" type="number" name="phone" value="<?php echo $phone; ?>"> </td></tr>



        <th width="5%">Employee Address</th>
        <tr><td><input style="width: 400px;" type="text" name="address" value="<?php echo $address; ?>"> </td></tr>


        <th width="5%">Employee Faculty</th>
        <tr><td><input style="width: 400px;" type="text" name="faculty" value="<?php echo $faculty; ?>"> </td></tr>




        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="form_employee"></td></tr>
    </table>
</form>
</body>
</html>

