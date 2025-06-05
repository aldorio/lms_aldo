<?php 
  $query = mysqli_query($config, "SELECT majors.name as majors_name, instructors.name as instructors_name, moduls.* FROM moduls LEFT JOIN majors ON majors.id = moduls.id_majors LEFT JOIN instructors ON instructors.id = moduls.id_instructors ORDER BY moduls.id DESC");
  $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data User</h5>
          <div class="mb-3" align="right">
            <a href="?page=tambah-moduls" class="btn btn-primary">Add Modul</a>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Instructors Name</th>
                  <th>Major</th>
                  <th>Title</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                      foreach($rows as $index => $row): ?>
                <tr>
                  <td><?php echo $index += 1;  ?></td>
                  <td><?php echo $row['instructors_name']?></td>
                  <td><?php echo $row['majors_name']?></td>
                  <td><?php echo $row['name']?></td>
                  
                  <td>
                        <a href="?page=tambah-moduls&edit=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Are u Sure wanna delete this?')" href="?page=tambah-moduls&delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>

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