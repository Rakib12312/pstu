<?php
if (isset($_POST['form_faculty'])) {

    try {

        if (empty($_POST['title'])) {
            throw new Exception("Faculty Title can not be  empty.");
        }

      if (empty($_FILES['icon_url'])) {
            throw new Exception("Teacher image not be empty.");
        }
        

   
        
        include_once './database.php';

        
        
          $target_dir = "/xampp/htdocs/pstu/uploads/";
        $file_basename = basename($_FILES["icon_url"]["name"]);
        $file_ext = pathinfo($file_basename, PATHINFO_EXTENSION);
        $up_filename = $file_basename . "." . $file_ext;
//                $img_url = "http://192.168.43.197/admin/uploads/".$up_filename;

        if (($file_ext != "png") && ($file_ext != "jpg") && ($file_ext != "jpeg") && ($file_ext != "gif"))
            throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");

        move_uploaded_file($_FILES["icon_url"]["tmp_name"], $target_dir . $up_filename);


        $statement = $db->prepare("INSERT INTO faculty ( title, icon_url) VALUES( ?, ?)");
        $statement->execute(array($_POST['title'], $up_filename));


        $success_message = "Faculty Added Successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<?php
include_once './header.php';
include_once './database.php';
?>



        <div class="col-md-8">
            <h2 class="text-success text-center">Add Employee</h2>
            <form method="post" class="form-group" enctype="multipart/form-data">

<?php
if (isset($error_message)) {
    echo "<div class='text-danger'>" . $error_message . "</div>";
}
if (isset($success_message)) {
    echo "<div class='text-success'>" . $success_message . "</div>";
}
?>

                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Faculty Name"/>
                </div>

                <div class="form-group">
                    <input type="file" name="icon_url" class="form-control"/>
                </div>

             <div class="form-group">
                    <input type="submit" name="form_faculty" value="Save" class="btn btn-primary"/>
                </div>
        
            </form>
        </div>
    </div>

</div>
<?php include_once './footer.php'; ?>