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
    header("location: edit_teacher.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['form_teacher'])) {
    try {

        if (empty($_POST['name'])) {
            throw new Exception("Teacher Name can not be empty.");
        }



        $statement = $db->prepare("UPDATE teacher SET name=? , designation=? , status=? , phone=? ,linked_in=? , address=?, email=? , department=? , faculty=? ,fb_link=? WHERE id=?");
        $statement->execute(array($_POST['name'], $_POST['designation'], $_POST['status'], $_POST['phone'], $_POST['linked_in'], $_POST['address'], $_POST['email'], $_POST['department'], $_POST['faculty'], $_POST['fb_link'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = "Teacher Information updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM teacher WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name = $row['name'];
    $designation = $row['designation'];
    $status = $row['status'];
    $phone = $row['phone'];
    $linked_in = $row['linked_in'];


    $address = $row['address'];
    $email = $row['email'];
    $department = $row['department'];

    $faculty = $row['faculty'];
    $fb_link = $row['fb_link'];
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
        <th width="5%">Teacher Name</th>
        <tr><td><input style="width: 400px;" type="text" name="name" value="<?php echo $name; ?>"> </td></tr>
        <th width="5%">Teacher Designation</th>
        <tr><td><textarea cols="47" rows="10" type="text" name="designation"><?php echo $designation; ?></textarea></td></tr>
        <th width="5%">Teacher Status</th>
        <tr><td><input style="width: 400px;" type="text" name="status" value="<?php echo $status; ?>"> </td></tr>
        <th width="5%">Teacher Phone</th>
        <tr><td><input style="width: 400px;" type="number" name="phone" value="<?php echo $phone; ?>"> </td></tr>


        <th width="5%">Teacher Linked In</th>
        <tr><td><input style="width: 400px;" type="text" name="linked_in" value="<?php echo $linked_in; ?>"> </td></tr>

        <th width="5%">Teacher Address</th>
        <tr><td><input style="width: 400px;" type="text" name="address" value="<?php echo $address; ?>"> </td></tr>
        <th width="5%">Teacher Email</th>
        <tr><td><input style="width: 400px;" type="text" name="email" value="<?php echo $email; ?>"> </td></tr>


        <th width="5%">Teacher Department</th>
        <tr><td><input style="width: 400px;" type="text" name="department" value="<?php echo $department; ?>"> </td></tr>

        <th width="5%">Teacher Faculty</th>
        <tr><td><input style="width: 400px;" type="text" name="faculty" value="<?php echo $faculty; ?>"> </td></tr>

        <th width="5%">Teacher Fb linked_in</th>
        <tr><td><input style="width: 400px;" type="text" name="fb_link" value="<?php echo $fb_link; ?>"> </td></tr>



        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="form_teacher"></td></tr>
    </table>
</form>
</body>
</html>

