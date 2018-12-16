<?php
include_once './header.php';
include_once './database.php';
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <th>#</th>
                 <th width="5%">Image</th>
                <th width="5%">Name</th>
                <th width="5%">Id</th>
                <th width="5%">Reg</th>
                <th width="5%">Contact</th>
                <th width="5%">Blood</th>
                <th width="5%">Address</th>
                 <th width="5%">Email</th> 
                 <th width="5%">Batch</th>
                  <th width="5%">Faculty</th>
                 
                </thead>
                <tbody>
<?php
$index = 1;
$statement_pr = $db->prepare("SELECT * FROM Student ORDER BY id DESC");
$statement_pr->execute();
$result = $statement_pr->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            
                            <td>  <img src="uploads/<?php echo $row['image']; ?>" alt="Student Image" style="width: 200px; height: 200px"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['reg']; ?></td>
                              <td><?php echo $row['contact']; ?></td>
                                <td><?php echo $row['blood']; ?></td>
                                  <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                      <td><?php echo $row['batch']; ?></td>  
                                      <td><?php echo $row['faculty']; ?></td>
                                      
                                
                          
                        </tr>
    <?php
    $index++;
}
?>
                </tbody>
            </table>
        </div>
        </div>
      </div>