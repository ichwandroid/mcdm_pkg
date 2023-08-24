<?php
ob_start();
include ("header.php");
require 'crud.php';
$success = "sukses";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nilai = $_POST['nilai'];
    $nilai2 = 0;
    if($nilai == 1){
        $nilai2 = 1;
    }else if($nilai == 2){
        $nilai2 = 3;
    }else if($nilai == 3){
        $nilai2 = 5;
    }else if($nilai == 4){
        $nilai2 = 7;
    }else if($nilai == 5){
        $nilai2 = 9;
    }
    $success = updatebobot($id, $nilai, $nilai2);
    if ($success > 0) {
        header('Location: bobot_view.php');
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}
$book = ambileditbobot($_GET['kode']);
$edit = mysqli_fetch_assoc($book);
$dafkom = viewdafkomp();
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi untuk mengubah kriteria dengan ID :<?php echo $edit['bobot_id'];?></h4></div>
  <div class="col-auto"><a  href="bobot_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<form  method="post">
<div class="form-group">
        <label>ID Kriteria</label>
        <input type="text"  class="form-control" name="id" value="<?php echo $edit['bobot_id']; ?>" disabled/>
        <input type="hidden" name="id" value="<?php echo $edit['bobot_id']; ?>" />
    </div>
    <div class="form-group">
        <label>Kriteria</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $dafkom[$_GET['komp']] ?>" disabled/>
    </div>
    <div class="form-group">
        <label>Bobot</label>
        <select class="form-control" name="nilai">
            <option value="1" <?php if($edit['bobot_nilai'] == '1'){ echo 'selected'; } ?>>Sangat Rendah</option>
            <option value="2" <?php if($edit['bobot_nilai'] == '2'){ echo 'selected'; } ?>>Rendah</option>
            <option value="3" <?php if($edit['bobot_nilai'] == '3'){ echo 'selected'; } ?>>Cukup</option>
            <option value="4" <?php if($edit['bobot_nilai'] == '4'){ echo 'selected'; } ?>>Tinggi</option>
            <option value="5" <?php if($edit['bobot_nilai'] == '5'){ echo 'selected'; } ?>>Sangat Tinggi</option>
        </select>
    </div>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Ubah
    </button>
</form>
<br/>
<?php
include ("footer.php");
?> 