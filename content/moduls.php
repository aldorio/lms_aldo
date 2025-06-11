<?php 
  $id_user = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
  $id_role = isset($_SESSION['ID_ROLE']) ? $_SESSION['ID_ROLE'] : '';

  // 
  $rowStudent = mysqli_fetch_assoc(mysqli_query($config, "SELECT * FROM students WHERE id='$id_user'"));
  $id_majors = isset ($rowStudent['id_majors']) ? $rowStudent['id_majors'] : '';

  if($id_role == 6){
    $where = "WHERE moduls.id_majors='$id_majors'";   
  }elseif($id_role == 4) {
    $where = "WHERE moduls.id_instructors='$id_user'";
  }

  $query = mysqli_query($config, "SELECT majors.name as majors_name, instructors.name as instructors_name, moduls.* 
  FROM moduls 
  LEFT JOIN majors ON majors.id = moduls.id_majors 
  LEFT JOIN instructors ON instructors.id = moduls.id_instructors 
  $where
  ORDER BY moduls.id DESC");
  $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Modul</h5>
          <?php if(canAddModul(4)): ?>
          <div class="mb-3" align="right">
            <a href="?page=tambah-moduls" class="btn btn-primary">Add Modul</a>
          </div>
          <?php endif ?>
          <div class="table-responsive">
            <table class="table table-bordered datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Instructors Name</th>
                  <th>Major</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                      foreach($rows as $index => $row): ?>
                <tr>
                  <td><?php echo $index += 1;  ?></td>
                  <td><a href="?page=tambah-moduls&detail=<?php echo $row['id'] ?>"><i class="bi bi-link"></i><?php echo $row['name']?></a></td>
                  <td><?php echo $row['instructors_name']?></td>
                  <td><?php echo $row['majors_name']?></td>
                  <td>
                    <?php if($id_role == 1): ?>
                        <a href="?page=tambah-moduls&edit=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a onclick="return confirm('Are u Sure wanna delete this?')" href="?page=tambah-moduls&delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                      <?php endif ?>
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