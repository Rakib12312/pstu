<?php
if (isset($_POST['form_teacher'])) {

    try {

        if (empty($_POST['t_name'])) {
            throw new Exception("Teacher name can not be  empty.");
        }

        if (empty($_POST['t_rank'])) {
            throw new Exception("Teacher rank can not be empty.");
        }

        if (empty($_POST['t_status'])) {
            throw new Exception("Teacher status not be empty.");
        }

        if (empty($_POST['t_contact'])) {
            throw new Exception("Teacher contact not be empty.");
        }

        if (empty($_POST['t_address'])) {
            throw new Exception("Teacher address not be empty.");
        }
       if (empty($_POST['t_email'])) {
            throw new Exception("Teacher email not be empty.");
        }
         if (empty($_POST['t_department'])) {
            throw new Exception("Teacher department not be empty.");
        }
          if (empty($_POST['t_faculty'])) {
            throw new Exception("Teacher faculty not be empty.");
        } 
       
         if (empty($_FILES['t_image'])) {
            throw new Exception("Teacher image not be empty.");
        }
        
        include_once './database.php';
//        $statement = $db->prepare("SHOW TABLE STATUS LIKE $t_name");
//        $statement->execute();
//        $result = $statement->fetchAll();
//        foreach ($result as $row)
//            $new_id = $row[10];


        $target_dir = "/xampp/htdocs/pstu/uploads/";
        $file_basename = basename($_FILES["t_image"]["name"]);
        $file_ext = pathinfo($file_basename, PATHINFO_EXTENSION);
        $up_filename = $file_basename . "." . $file_ext;
//                $img_url = "http://192.168.43.197/admin/uploads/".$up_filename;

        if (($file_ext != "png") && ($file_ext != "jpg") && ($file_ext != "jpeg") && ($file_ext != "gif"))
            throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");

        move_uploaded_file($_FILES["t_image"]["tmp_name"], $target_dir . $up_filename);


        $statement = $db->prepare("INSERT INTO teacher (name, rank, status, contact, address, email, department,faculty,image) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array($_POST['t_name'], $_POST['t_rank'], $_POST['t_status'],$_POST['t_contact'],$_POST['t_address'],$_POST['t_email'],$_POST['t_department'],$_POST['t_faculty'], $up_filename));


        $success_message = "Teacher Added Successfully.";
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
            <h2 class="text-success text-center">Add Teacher</h2>
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
                    <input type="text" name="t_name" class="form-control" placeholder="Teacher Name"/>
                </div>

                <div class="form-group">
                    <input type="text" name="t_rank"  class="form-control" placeholder="Teacher rank"/>
                </div>

                <div class="form-group">
                    <input type="text" name="t_status" class="form-control" placeholder="Teacher Status"/>
                </div>

                <div class="form-group">
                    <input type="file" name="t_image" class="form-control"/>
                </div>

                <div class="form-group">
                    <input type="number" name="t_contact" class="form-control" placeholder="Teacher Contact"/>
                </div>

                <div class="form-group">
                    <input type="text" name="t_department"  class="form-control" placeholder="Teacher Department"/>
                </div>
                  <div class="form-group">
                    <input type="text" name="t_address"  class="form-control" placeholder="Teacher Address"/>
                </div>
                   <div class="form-group">
                    <input type="text" name="t_email"  class="form-control" placeholder="Teacher Email"/>
                </div>
                
             
                
                  <div class="form-group">
                    <input type="text" name="t_faculty"  class="form-control" placeholder="Teacher Faculty"/>
                </div>

                <div class="form-group">
                    <input type="submit" name="form_teacher" value="Save" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>

</div>
<?php include_once './footer.php'; ?>