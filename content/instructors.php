<?php 

  
  $query = mysqli_query($config, "SELECT * FROM instructors ORDER BY id DESC");
  $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Instructors</h5>
          <div class="mb-3" align="right">
            <a href="?page=tambah-instructors" class="btn btn-primary">Add Instructors</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Education</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                      foreach($rows as $index => $row): ?>
                <tr>
                  <td><?php echo $index += 1;  ?></td>
                  <td><?php echo $row['name']?></td>
                  <td><?php echo $row['gender'] == 1 ? 'Male' : 'Female'?></td>
                  <td><?php echo $row['education']?></td>
                  <td><?php echo $row['phone']?></td>
                  <td><?php echo $row['email']?></td>
                  <td><?php echo $row['address']?></td>
                  <td>
                        <a href="?page=tambah-instructors-majors&id=<?php echo $row ['id'] ?>" class="btn btn-warning">Add Majors</a>
                        <a href="?page=tambah-instructors&edit=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Are u Sure wanna delete this?')" href="?page=tambah-instructors&delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>

                  </td>
                </tr>
                 <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>