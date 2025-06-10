<?php 
if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  $queryModulsDetails = mysqli_query($config, "SELECT file FROM moduls_details WHERE id_modul ='$id'");
  $rowModulsDetails = mysqli_fetch_assoc($queryModulsDetails);
  unlink("uploads/".$rowModulsDetails['file']);

  $queryDelete = mysqli_query($config, "DELETE FROM moduls_details WHERE id_modul = '$id'");
  $queryDelete = mysqli_query($config, "DELETE FROM moduls WHERE id = '$id'");
  if($queryDelete) {
    header("location:?page=moduls&hapus=berhasil");
  } else {
    header("location:?page=moduls&hapus=gagal");
  }

}

$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM majors WHERE id = '$id_user'");
$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';

if(isset($_POST['save'])){
  // ada tidak sebuah parameter bernama edit, kalau ada jalankan perintah edit/update
  // kalau tidak ada makan tambah data baru/insert
  $id_instructors = $_POST['id_instructors'];
  $id_majors = $_POST['id_majors'];
  $name = $_POST['name'];
  
  $insert = mysqli_query($config, "INSERT INTO moduls (id_majors, id_instructors, name) VALUES('$id_majors', '$id_instructors', '$name')");

  if($insert){
    $id_modul = mysqli_insert_id($config);
    // $_FILES
    foreach ($_FILES['file']['name'] as $index => $file){
      if ($_FILES['file']['error'][$index] == 0){
        $name = basename($_FILES ['file']['name'][$index]);
        $fileName = uniqid() . "-" . $name;
        $path = "uploads/";
        $targetPath = $path . $fileName;

        if(move_uploaded_file($_FILES['file']['tmp_name'][$index], $targetPath)) {
          $insertModulDetail = mysqli_query($config, "INSERT INTO moduls_details (id_modul, file) VALUES ('$id_modul','$fileName')");
        }
      }
    }
    header("location=?page=moduls&tambah=berhasil");

  }

}

$id_instructors = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$queryInstructorsMajors = mysqli_query($config, "SELECT majors.name, instructors_majors.* FROM instructors_majors LEFT JOIN majors ON majors.id = instructors_majors.id_majors WHERE instructors_majors.id_instructors = '$id_instructors'");

$rowInstructorsMajors = mysqli_fetch_all($queryInstructorsMajors, MYSQLI_ASSOC);

$id_modul = isset($_GET['detail']) ? $_GET['detail'] : '';
$queryModul = mysqli_query($config, "SELECT majors.name as majors_name, instructors.name as instructors_name, moduls.* FROM moduls LEFT JOIN majors ON majors.id = moduls.id_majors LEFT JOIN instructors ON instructors.id = moduls.id_instructors WHERE moduls.id='$id_modul'");
$rowModul = mysqli_fetch_assoc($queryModul);

// query ke table detail modul
$queryDetailModul = mysqli_query($config, "SELECT * FROM moduls_details WHERE id_modul='$id_modul'");
$rowDetailModuls = mysqli_fetch_all($queryDetailModul, MYSQLI_ASSOC);

if(isset($_GET['download'])){
  $file = $_GET['download'];
  $filePath = "uploads/" . $file;
  if(file_exists($filePath)){
    header("Content-Description: File Transfer");
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . basename($filePath) . "");
    header('Expires: 0');
    header("Cache-Control:-must-revalidate");
    header("Pragma:public");
    header("Content-Length:" . filesize($filePath) . "");
    ob_clean();
    flush();
    readfile($filePath);
    exit;
  }

  // print_r($file);
  // die;
}

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo isset($_GET['detail']) ? 'Detail' : 'Add' ?>Majors</h5>

        <?php if(isset($_GET['detail'])) : ?>
              <!-- detail modul -->
              <table class="table table-stripped">
                <tr>
                  <th>Modul Name</th>
                  <th>:</th>
                  <td><?php echo $rowModul['name'] ?></td>
                  <th>Major</th>
                  <th>:</th>
                  <td><?php echo $rowModul['majors_name']?></td>
                </tr>
                <tr>
                  <th>Instructor Name</th>
                  <th>:</th>
                  <td><?php echo $rowModul['instructors_name']?></td>
                </tr>
              </table>
              <br>
              <br>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rowDetailModuls as $index => $rowDetailModul): ?>
                  <tr>
                    <td><?php echo $index += 1; ?></td> 
                    <td>
                      <a target="_blank" href="?page=tambah-moduls&download=<?php echo urlencode($rowDetailModul['file']) ?>"><?php echo $rowDetailModul['file'] ?> <i class="bi bi-download"></i></a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>

              </table>
          <?php else: ?>
            <!-- form tambah modul -->
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Instructor Name *</label>
                    <input readonly value="<?php echo $_SESSION['NAME'] ?>" type="text" class="form-control" required>
                    <input type="hidden" name="id_instructors" value="<?php echo $_SESSION['ID_USER'] ?>">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Modul Name *</label>
                    <input type="text" class="form-control" name="name" value="" placeholder="Enter Modul Name" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="" class="form-label">Major Name *</label>
                    <select name="id_majors" id="" class="form-control" required>
                      <option value="">Select One</option>
                      <?php foreach($rowInstructorsMajors as $row) :?>
                      <option value="<?php echo ($row['id_majors']) ?>"><?php echo $row['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
  
              <div align="right" class="mb-3">
                <button type="button" class="btn btn-primary addRow" name="addRow">Add Row</button>
              </div>
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th>File</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
  
                </tbody>
              </table>
              <div class="mb-3">
                <input type="submit" class="btn btn-success" name="save" value="save">
              </div>
            </form>

            <?php endif ?>


      </div>
    </div>
  </div>
</div>

<script>
// var, let,const, 
// var: ketika nilainya tidak ada/tidak error
// let: harus mempunyai nilai
// const : nilainya tidak boleh berubah
// const nama = "bambang";
// nama = "reza";
// const button = document.getElementById('addRow');
// const button = document.getElementsByClassName('addRow');
const button = document.querySelector('.addRow');
const tbody = document.querySelector('#myTable tbody');
// button.textContent = "Duarr";
// button.style.color = "red";

button.addEventListener("click", function(){
  // alert('Duarr');
  const tr = document.createElement('tr');
  tr.innerHTML =`<td><input type='file' name='file[]'></td><td>Delete</td>`;

  tbody.appendChild(tr);
});
</script>