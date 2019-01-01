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
    header("location: edit_batch.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['form_batch'])) {
    try {

        if (empty($_POST['name'])) {
            throw new Exception("Information Name can not be empty.");
        }



        $statement = $db->prepare("UPDATE batch SET name=?, title=?, session=?, faculty=? ,total_student=?   WHERE id=?");
        $statement->execute(array($_POST['name'], $_POST['title'], $_POST['session'], $_POST['faculty'], $_POST['total_student'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = " Information updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM batch WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $name = $row['name'];
    $title = $row['title'];
    $session = $row['session'];
    $faculty = $row['faculty'];
    $total_student = $row['total_student'];
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
        <th width="5%">Batch Name</th>
        <tr><td><input style="width: 400px;" type="text" name="name" value="<?php echo $name; ?>"> </td></tr>

        <th width="5%">Batch Title</th>
        <tr><td><input style="width: 400px;" type="text" name="title" value="<?php echo $title; ?>"> </td></tr>
        <th width="5%">Session</th>
        <tr><td><input style="width: 400px;" type="text" name="session" value="<?php echo $session; ?>"> </td></tr>
        <th width="5%">Faculty</th>
        <tr><td><input style="width: 400px;" type="text" name="faculty" value="<?php echo $faculty; ?>"> </td></tr>
        <th width="5%">Total Student</th>
        <tr><td><input style="width: 400px;" type="text" name="total_student" value="<?php echo $total_student; ?>"> </td></tr>

        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="form_batch"></td></tr>
    </table>
</form>
</body>
</html>

