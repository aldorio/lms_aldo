<?php 

  
  $query = mysqli_query($config, "SELECT * FROM roles ORDER BY id DESC");
  $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Roles</h5>
          <div class="mb-3" align="right">
            <a href="?page=tambah-roles" class="btn btn-primary">Add Roles</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                      foreach($rows as $index => $row): ?>
                <tr>
                  <td><?php echo $index += 1;  ?></td>
                  <td><?php echo $row['name']?></td>
                  <td>
                        <a href="?page=tambah-roles&add-role-menu=<?php echo $row['id'] ?>" class="btn btn-success">Add Role Menu</a>
                        <a href="?page=tambah-roles&edit=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Are u Sure wanna delete this?')" href="?page=tambah-roles&delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>

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