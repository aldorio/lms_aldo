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

if(isset($_GET['add-role-menu'])){
  $id_role = $_GET['add-role-menu'];
  
  $rowEditRoleMenu = [];
  $editRoleMenu = mysqli_query($config, "SELECT * FROM menu_roles where id_roles='$id_role'");
  // $rowEditRoleMenu = mysqli_fetch_all($editRoleMenu, MYSQLI_ASSOC);
  while ($editMenu = mysqli_fetch_assoc($editRoleMenu)){
    $rowEditRoleMenu[] = $editMenu['id_menu'];
  }

  $menus = mysqli_query($config, "SELECT * FROM menus ORDER BY parent_id, urutan");
  $rowMenu = [];
  while ($m = mysqli_fetch_assoc($menus)) {
    $rowMenu[] = $m;
  }
}

if(isset($_POST['save'])){
  $id_role = $_GET['add-role-menu'];
  $id_menus = $_POST['id_menus'] ?? [];

  // foreach($id_menus as $m){
  //   $id_menu = $m;
  //   $insert = mysqli_query($config, "INSERT INTO menu_roles(id_roles, id_menu) VALUES ('$id_role', '$id_menu')");
    
  // }

  mysqli_query($config,"DELETE FROM menu_roles WHERE id_roles = '$id_role'");
  foreach ($id_menus as $m) {
    $id_menu = $m;
    $insert = mysqli_query($config, "INSERT INTO menu_roles(id_roles, id_menu) VALUES ('$id_role', '$id_menu')");
  }

  header("location:?page=tambah-roles&add-role-menu=" . $id_role."&tambah=berhasil");
  
}




?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($rowEdit['id']) ? 'Edit' : 'Add' ?> Roles</h5>
          <?php if(isset($_GET['add-role-menu'])): ?>
              <form action="" method="post">
                  <div class="mb-3">
                    <ul>
                      <?php foreach($rowMenu as $key => $mainMenu): ?>
                        <?php if($mainMenu['parent_id'] == 0 or $mainMenu['parent_id'] == ""): ?>
                      <li>
                        <label for="">
                          <input <?php echo in_array($mainMenu['id'], $rowEditRoleMenu) ? 'checked' :'' ?> type="checkbox" name="id_menus[]" value="<?php echo $mainMenu ['id'] ?>">
                          <?php echo $mainMenu['name'] ?>
                        </label>
                        <ul>
                          <?php foreach($rowMenu as $subMenu): ?>
                            
                            <?php if($subMenu['parent_id'] == $mainMenu['id']): ?>
                          <li>
                             <label for="">

                          <input <?php echo in_array($mainMenu['id'], $rowEditRoleMenu) ? 'checked' :'' ?> type="checkbox" name="id_menus[]" value="<?php echo $subMenu ['id'] ?>">
                          <?php echo $subMenu['name'] ?>
                        </label>
                          </li>
                          <?php endif ?>
                          <?php endforeach ?>
                        </ul>
                      </li>
                      <?php endif ?>

                      <?php endforeach ?>
                    </ul>
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary" type="submit" name="save">Save Change</button>
                  </div>

              </form>
            <?php elseif (isset($_GET['edit'])): ?>
          <form action="" method="post">
              <div class="mb-3">
              <label for="">Roles *</label>
              <input value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : '' ?>" type="text" class="form-control" name="name" placeholder="Enter Your Roles" required>
            </div>
            <div class="mb-3">
              
              <input type="submit" class="btn btn-success" name="save" value="save">
            <div>
          </form>
          <?php endif ?>

      </div>
    </div>
  </div>
</div>