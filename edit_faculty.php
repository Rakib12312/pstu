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
    header("location: edit_faculty.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['form_faculty'])) {
    try {

        if (empty($_POST['title'])) {
            throw new Exception("Title Name can not be empty.");
        }



        $statement = $db->prepare("UPDATE faculty SET short_title=?, title=?   WHERE id=?");
        $statement->execute(array($_POST['short_title'], $_POST['title'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = " Faculty updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM faculty WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $short_title = $row['short_title'];
    $title = $row['title'];
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
        <th width="5%">Short title</th>
        <tr><td><input style="width: 400px;" type="text" name="short_title" value="<?php echo $short_title; ?>"> </td></tr>

        <th width="5%">Title</th>
        <tr><td><input style="width: 400px;" type="text" name="title" value="<?php echo $title; ?>"> </td></tr>

        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="form_faculty"></td></tr>
    </table>
</form>
</body>
</html>

