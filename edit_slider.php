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
    header("location: details_slider.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['form_slider'])) {
    try {

        if (empty($_POST['title'])) {
            throw new Exception("Title  can not be empty.");
        }



        $statement = $db->prepare("UPDATE slider SET title=? , image_url=?  WHERE id=?");
        $statement->execute(array($_POST['title'], $_POST['image_url'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = "Slider updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM slider WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $title = $row['title'];
    $image_url = $row['image_url'];
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
        <th width="5%">Title Name</th>
        <tr><td><input style="width: 400px;" type="text" name="title" value="<?php echo $title; ?>"> </td></tr>
        <th width="5%">Image Url</th>
        <tr><td><textarea cols="47" rows="10" type="text" name="image_url"><?php echo $image_url; ?></textarea></td></tr>






        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="form_slider"></td></tr>
    </table>
</form>
</body>
</html>

