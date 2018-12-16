<?php
if (isset($_POST['form_employee'])) {

    try {

        if (empty($_POST['e_name'])) {
            throw new Exception("Employee name can not be  empty.");
        }

        if (empty($_POST['e_rank'])) {
            throw new Exception("Employee rank can not be empty.");
        }

        if (empty($_POST['e_department'])) {
            throw new Exception("Employee department not be empty.");
        }

        if (empty($_POST['e_contact'])) {
            throw new Exception("Employee contact not be empty.");
        }

        if (empty($_POST['e_address'])) {
            throw new Exception("Employee address not be empty.");
        }
     
         if (empty($_POST['e_faculty'])) {
            throw new Exception(" Employee Faculty  not be empty.");
        }
     
         if (empty($_FILES['e_image'])) {
            throw new Exception("Employee image not be empty.");
        }
        
        include_once './database.php';
//        $statement = $db->prepare("SHOW TABLE STATUS LIKE $t_name");
//        $statement->execute();
//        $result = $statement->fetchAll();
//        foreach ($result as $row)
//            $new_id = $row[10];


        $target_dir = "/xampp/htdocs/pstu/uploads/";
        $file_basename = basename($_FILES["e_image"]["name"]);
        $file_ext = pathinfo($file_basename, PATHINFO_EXTENSION);
        $up_filename = $file_basename . "." . $file_ext;
//                $img_url = "http://192.168.43.197/admin/uploads/".$up_filename;

        if (($file_ext != "png") && ($file_ext != "jpg") && ($file_ext != "jpeg") && ($file_ext != "gif"))
            throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");

        move_uploaded_file($_FILES["e_image"]["tmp_name"], $target_dir . $up_filename);


        $statement = $db->prepare("INSERT INTO employer (name, rank, department, contact, address, faculty, image) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array($_POST['e_name'], $_POST['e_rank'], $_POST['e_department'],$_POST['e_contact'],$_POST['e_address'],$_POST['e_faculty'], $up_filename));


        $success_message = "Employee Added Successfully.";
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
                    <input type="text" name="e_name" class="form-control" placeholder="Employee Name"/>
                </div>

                <div class="form-group">
                    <input type="text" name="e_rank"  class="form-control" placeholder="Employee rank"/>
                </div>

                <div class="form-group">
                    <input type="text" name="e_department" class="form-control" placeholder="Employee Department"/>
                </div>

                <div class="form-group">
                    <input type="file" name="e_image" class="form-control"/>
                </div>

                <div class="form-group">
                    <input type="number" name="e_contact" class="form-control" placeholder="Employee Contact"/>
                </div>

                  <div class="form-group">
                    <input type="text" name="e_address"  class="form-control" placeholder="Employee Address"/>
                </div>
                  
                
             
                
                  <div class="form-group">
                    <input type="text" name="e_faculty"  class="form-control" placeholder="Employee Faculty"/>
                </div>

                <div class="form-group">
                    <input type="submit" name="form_employee" value="Save" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>

</div>
<?php include_once './footer.php'; ?>