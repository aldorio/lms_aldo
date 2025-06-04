<?php 
if(isset($_GET['delete'])){
  $id_user = $_GET['delete'];
  $queryDelete = mysqli_query($config, "DELETE FROM roles WHERE id = $id_user");
  if($queryDelete) {
    header("location:?page=roles&hapus=berhasil");
  } else {
    header("location:?page=roles&hapus=gagal");
  }

}

$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM roles WHERE id = '$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if(isset($_POST['name'])){
  // ada tidak sebuah parameter bernama edit, kalau ada jalankan perintah edit/update
  // kalau tidak ada makan tambah data baru/insert
  $name = $_POST['name'];


  if(!isset($_GET['edit'])){
    $insert = mysqli_query($config, "INSERT INTO roles (name) VALUES('$name')");
    header("location:?page=roles&tambah=berhasil");
  }else{
    $update = mysqli_query($config, "UPDATE roles SET name='$name' WHERE id='$id_user'");
    header("location:?page=roles&ubah=berhasil");
  }

}


?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Add Roles</h5>

          <form action="" method="post">
              <div class="mb-3">
              <label for="">Roles *</label>
              <input value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>" type="text" class="form-control" name="name" placeholder="Enter Your Roles" required>
            </div>
            <div class="mb-3">
              
              <input type="submit" class="btn btn-success" name="save" value="save">
            </div>
          </form>

      </div>
    </div>
  </div>
</div>