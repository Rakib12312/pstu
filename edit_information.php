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
    header("location: edit_information.php");
} else {
    $id = $_REQUEST['id'];
}
?>



<?php
if (isset($_POST['donation_option'])) {
    try {

        if (empty($_POST['donation'])) {
            throw new Exception("Information Name can not be empty.");
        }



        $statement = $db->prepare("UPDATE info SET donation_option=?   WHERE id=?");
        $statement->execute(array($_POST['donation_option'], $id));
        //header("location: product.php?brand=$table_name");
        $success_message = " Information updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<?php
//include_once './database_file.php';
$statement = $db->prepare("SELECT * FROM info WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $donation_option = $row['donation_option'];
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
        <th width="5%">Donation option</th>
        <tr><td><input style="width: 400px;" type="text" name="donation_option" value="<?php echo $donation_option; ?>"> </td></tr>


        <tr><td><input style="background-color: #b9cec7;" type="submit" value="Save" name="donation"></td></tr>
    </table>
</form>
</body>
</html>

