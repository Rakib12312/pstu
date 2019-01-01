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
    header("location: edit_student.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['form_student'])) {
    try {

        if (empty($_POST['name'])) {
            throw new Exception("Student Name can not be empty.");
        }

        if (empty($_POST['id'])) {
            throw new Exception(" Student id can not be empty.");
        }


        $statement = $db->prepare("UPDATE student SET name=? , id=? , reg=? , phone=? ,linked_in=?, blood=? , address=?, email=? , batch=?, session=? , faculty=? ,fb_link=? WHERE id=?");
        $statement->execute(array($_POST['name'], $_POST['id'], $_POST['reg'], $_POST['phone'], $_POST['linked_in'], $_POST['blood'], $_POST['address'], $_POST['email'], $_POST['batch'], $_POST['session'], $_POST['faculty'], $_POST['fb_link'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = "Student Information updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM student WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name = $row['name'];
    $id = $row['id'];
    $reg = $row['reg'];
    $phone = $row['phone'];
    $linked_in = $row['linked_in'];
    $blood = $row['blood'];

    $address = $row['address'];
    $email = $row['email'];
    $batch = $row['batch'];

    $session = $row['session'];
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

        <th width="5%">Student Name</th>
        <tr><td><input style="width: 400px;" type="text" name="name" value="<?php echo $name; ?>"> </td></tr>
        <th width="5%">Student Id</th>
        <tr><td><textarea cols="47" rows="10" type="text" name="id"><?php echo $id; ?></textarea></td></tr>
        <th width="5%">Student Registration</th>
        <tr><td><input style="width: 400px;" type="text" name="reg" value="<?php echo $reg; ?>"> </td></tr>
        <th width="5%">Student Phone</th>
        <tr><td><input style="width: 400px;" type="number" name="phone" value="<?php echo $phone; ?>"> </td></tr>


        <th width="5%">Student Linked In</th>
        <tr><td><input style="width: 400px;" type="text" name="linked_in" value="<?php echo $linked_in; ?>"> </td></tr>
        <th width="5%">Student Blood</th>
        <tr><td><textarea cols="47" rows="10" type="text" name="blood"><?php echo $blood; ?></textarea></td></tr>
        <th width="5%">Student Address</th>
        <tr><td><input style="width: 400px;" type="text" name="address" value="<?php echo $address; ?>"> </td></tr>
        <th width="5%">Student Email</th>
        <tr><td><input style="width: 400px;" type="text" name="email" value="<?php echo $email; ?>"> </td></tr>


        <th width="5%">Student Batch</th>
        <tr><td><input style="width: 400px;" type="text" name="batch" value="<?php echo $batch; ?>"> </td></tr>
        <th width="5%">Student Session</th>
        <tr><td><textarea cols="47" rows="10" type="text" name="session"><?php echo $session; ?></textarea></td></tr>
        <th width="5%">Student Faculty</th>
        <tr><td><input style="width: 400px;" type="text" name="faculty" value="<?php echo $faculty; ?>"> </td></tr>
        <th width="5%">Student Fb Link</th>
        <tr><td><input style="width: 400px;" type="text" name="fb_link" value="<?php echo $fb_link; ?>"> </td></tr>



        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="form_student class="btn btn-primary""></td></tr>

    </table>
</form>
</body>
</html>

