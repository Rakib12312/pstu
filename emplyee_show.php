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
                <th width="5%">Rank</th>
                <th width="5%">Department</th>
                <th width="5%">Contact</th>
            
                <th width="5%">Address</th>
                 
                  <th width="5%">Faculty</th>
                 
                </thead>
                <tbody>
<?php
$index = 1;
$statement_pr = $db->prepare("SELECT * FROM employer ORDER BY id DESC");
$statement_pr->execute();
$result = $statement_pr->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            
                            <td>  <img src="uploads/<?php echo $row['image']; ?>" alt="Employee Image" style="width: 200px; height: 200px"></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['rank']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                              <td><?php echo $row['contact']; ?></td>
                            
                                  <td><?php echo $row['address']; ?></td>
                           
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