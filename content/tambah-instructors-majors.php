<?php 
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $id_instructors = $_GET['id_instructors'];

  $queryDelete = mysqli_query($config, "DELETE FROM instructors_majors WHERE id = '$id'");
  if($queryDelete) {
   header("location:?page=tambah-instructors-majors&id=" . $id_instructors . "&hapus=berhasil");
  } else {
    header("location:?page=tambah-instructors-majors&id=" . $id_instructors . "&hapus=gagal");
  }

}



$id_instructors = isset($_GET['id']) ? $_GET['id'] : '';
$edit = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM instructors_majors WHERE id = '$edit'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if(isset($_POST['id_majors'])){
  // ada tidak sebuah parameter bernama edit, kalau ada jalankan perintah edit/update
  // kalau tidak ada makan tambah data baru/insert
  $id_majors = $_POST['id_majors'];
  
  // $id_instructors = $_POST['id_instructors'];
  
  if(isset($_GET['edit'])){
    $update = mysqli_query($config, "UPDATE instructors_majors SET id_majors='$id_majors', id_instructors='$id_instructors'  WHERE id='$edit'");
      header("location:?page=tambah-instructors-majors&id=" . $id_instructors . "&ubah=berhasil");
    
  }else
  
  $insert = mysqli_query($config, "INSERT INTO instructors_majors (id_majors,id_instructors) VALUES('$id_majors','$id_instructors')");
  header("location:?page=tambah-instructors-majors&id=" . $id_instructors . "&tambah=berhasil");

}

$queryMajors = mysqli_query($config, "SELECT * FROM majors ORDER BY id DESC");
$rowMajors = mysqli_fetch_all($queryMajors, MYSQLI_ASSOC);

$queryInstructors = mysqli_query($config, "SELECT * FROM instructors WHERE id ='$id_instructors'");
$rowInstructors = mysqli_fetch_assoc($queryInstructors);

$queryInstructorsMajors = mysqli_query($config, "SELECT majors.name, instructors_majors.id, id_instructors FROM instructors_majors LEFT JOIN majors ON majors.id = instructors_majors.id_majors WHERE id_instructors = '$id_instructors' ORDER BY instructors_majors.id DESC");
$rowInstructorsMajors = mysqli_fetch_all($queryInstructorsMajors, MYSQLI_ASSOC);



?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> Instructors Majors : <?php echo $rowInstructors['name']?> </h5>
        <!-- form edit -->

        <?php if(isset($_GET['edit'])): ?>
          <form action="" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="">Majors Name</label>
            <select name="id_majors" id="" class="form-control">
              <option value="">Select One</option>
              <?php foreach($rowMajors as $rowMajor):?>
              <option <?php echo ($rowMajor['id'] == $rowEdit['id_majors']) ? 'selected' : ''?> value="<?php echo $rowMajor['id'] ?>"><?php echo $rowMajor['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="save" value="save">Save changes</button>
        </div>
        
      </form>
        <!-- endform edit -->
        <?php else: ?>
           <div align="right">
          <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Add Instructors Majors
          </button>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
            <th>No</th>
            <th>Major Name</th>
            <th></th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
             foreach ($rowInstructorsMajors as $index => $rowInstructorsMajor):?>

            <tr>
              <!-- <td><?php echo $index +=1 ?> </td> -->
              <td><?php echo $no++ ?></td>
              <td><?php echo $rowInstructorsMajor['name']?></td>
              <td>
                  <a href="?page=tambah-instructors-majors&id=<?php echo $rowInstructorsMajor['id_instructors'] ?>&edit=<?php echo $rowInstructorsMajor['id'] ?>" class="btn btn-primary">Edit</a>
                   <a onclick="return confirm('Are u Sure wanna delete this?')" href="?page=tambah-instructors-majors&delete=<?php echo $rowInstructorsMajor['id'] ?>&id_instructors=<?php echo $rowInstructorsMajor['id_instructors'] ?>" class="btn btn-danger">Delete</a>

              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <?php endif ?>
          <!-- listing table -->
       

          

      </div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Instructors Majors :</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label for="">Majors Name</label>
            <select name="id_majors" id="" class="form-control">
              <option value="">Select One</option>
              <?php foreach($rowMajors as $rowMajor):?>
              <option value="<?php echo $rowMajor['id'] ?>"><?php echo $rowMajor['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="save" value="save">Save changes</button>
        </div>
        
      </form>
    </div>
  </div>
</div>