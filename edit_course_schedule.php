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
    header("location: edit_course_schedule.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['form_course'])) {
    try {

        if (empty($_POST['course_code'])) {
            throw new Exception("Course_schedule  can not be empty.");
        }



        $statement = $db->prepare("UPDATE course_schedule SET course_code=?, course_title=?, credit_hour=?, faculty=? ,status=?   WHERE id=?");
        $statement->execute(array($_POST['course_code'], $_POST['course_title'], $_POST['credit_hour'], $_POST['faculty'], $_POST['status'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = " Course Schedule updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM course_schedule WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $course_code = $row['course_code'];
    $course_title = $row['course_title'];
    $credit_hour = $row['credit_hour'];
    $faculty = $row['faculty'];
    $status = $row['status'];
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
        <th width="5%"> Course Code </th>
        <tr><td><input style="width: 400px;" type="text" name="course_code" value="<?php echo $course_code; ?>"> </td></tr>

        <th width="5%">Course Title</th>
        <tr><td><input style="width: 400px;" type="text" name="course_title" value="<?php echo $course_title; ?>"> </td></tr>
        <th width="5%">Credit Hour</th>
        <tr><td><input style="width: 400px;" type="text" name="credit_hour" value="<?php echo $credit_hour; ?>"> </td></tr>
        <th width="5%">Faculty</th>
        <tr><td><input style="width: 400px;" type="text" name="faculty" value="<?php echo $faculty; ?>"> </td></tr>
        <th width="5%">Status</th>
        <tr><td><input style="width: 400px;" type="text" name="status" value="<?php echo $status; ?>"> </td></tr>

        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="form_course"></td></tr>
    </table>
</form>
</body>
</html>

