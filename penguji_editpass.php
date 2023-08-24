<?php
ob_start();
include ("header.php");
require 'crud.php';
$success = "sukses";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $success = updatepengujiuser($id, $user, $pass);
    if ($success > 0) {
        header('Location: penguji_view.php');
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}
$book = ambileditpengujipass($_SESSION['username']);
$edit = mysqli_fetch_assoc($book);
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi untuk mengubah data penguji dengan ID :<?php echo $edit['penguji_id']; ?></h4></div>
  <div class="col-auto"><a  href="penguji_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<form  method="post">
    <input type="hidden"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo $edit['penguji_id']; ?>" />
    <div class="form-group">
        <label>Nama Pengguna (Username)</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Pengguna" name="user" value="<?php echo $edit['username'];?>"/>
    </div>
    <div class="form-group">
        <label>Sandi</label>
        <input type="password" class="form-control" placeholder="Silahkan isi dengan Sandi" name="pass"/>
    </div>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Ubah
    </button>
</form>
<br/>
<?php
include ("footer.php");
?> 