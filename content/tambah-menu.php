<?php 
if(isset($_GET['delete'])){
  $id_user = $_GET['delete'];
  $queryDelete = mysqli_query($config, "DELETE FROM menus WHERE id = $id_user");
  if($queryDelete) {
    header("location:?page=menu&hapus=berhasil");
  } else {
    header("location:?page=menu&hapus=gagal");
  }

}

$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM menus WHERE id = '$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if(isset($_POST['name'])){
  // ada tidak sebuah parameter bernama edit, kalau ada jalankan perintah edit/update
  // kalau tidak ada makan tambah data baru/insert
  $name = $_POST['name'];
  $icon = $_POST['icon'];
  $urutan = $_POST['urutan'];
  $url = $_POST['url'];
  $parent_id = $_POST['parent_id'];


  if(!isset($_GET['edit'])){
    $insert = mysqli_query($config, "INSERT INTO menus (name, icon, urutan, url, parent_id) VALUES('$name', '$icon', '$urutan', '$url', '$parent_id')");
    header("location:?page=menu&tambah=berhasil");
  }else{
    $update = mysqli_query($config, "UPDATE menus SET name='$name', parent_id='$parent_id', icon='$icon', urutan='$urutan', url='$url' WHERE id='$id'");
    header("location:?page=menu&ubah=berhasil");
  }

}

$queryParentId = mysqli_query($config, "SELECT * FROM menus WHERE parent_id = 0 OR parent_id='' ");
$rowParentId = mysqli_fetch_all($queryParentId, MYSQLI_ASSOC);


?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Add Menu</h5>

          <form action="" method="post">
              <div class="mb-3">
              <label for="">Name *</label>
              <input value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>" type="text" class="form-control" name="name" placeholder="Enter Name Menu" required>
            </div>
            <div class="mb-3">
              <label for="">Parent ID</label>
              <select name="parent_id" id="" class="form-control">
                <option value="">Select One</option>
                <?php foreach ($rowParentId as $parentId): ?>
                  <option value="<?php echo $parentId['id']?>"><?php echo $parentId['name']?></option>
                  <?php endforeach ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="">Icon *</label>
              <input value="<?php echo isset($rowEdit['icon']) ? $rowEdit['icon'] : '' ?>" type="text" class="form-control" name="icon" placeholder="Enter Icon Menu" required>
            </div>
            <div class="mb-3">
              <label for="">URL </label>
              <input value="<?php echo isset($rowEdit['url']) ? $rowEdit['url'] : '' ?>" type="text" class="form-control" name="url" placeholder="Enter Url Menu" >
            </div>
            <div class="mb-3">
              <label for="">Urutan </label>
              <input value="<?php echo isset($rowEdit['urutan']) ? $rowEdit['urutan'] : '' ?>" type="number" class="form-control" name="urutan" placeholder="Enter Order Menu">
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-success" name="save" value="save">
            </div>
          </form>

      </div>
    </div>
  </div>
</div>