<?php
include ("header.php");
require 'crud.php';
$success = "sukses";
$id = "";
$nama = "";
$nuptk = "";
$user = "";
$pass = "";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nuptk = $_POST['nuptk'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $success = addpenguji($id, $nama, $nuptk, $user, $pass);
    if ($success > 0) {
        $id = "";
        $nama = "";
        $nuptk = "";
        $user = "";
        $pass = "";
        echo' <div class="alert alert-success" role="alert">
            <strong>Sukses</strong>, data telah berhasil diinputkan.
        </div>';
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}

//if ($success < 1) {
//    echo $success;
//}
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi form berikut untuk menambah penguji</h4></div>
  <div class="col-auto"><a  href="penguji_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>

<form  method="post">
    <div class="form-group">
        <label>ID</label>
        <input type="text"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo($id); ?>" required/>
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Penguji" name="nama" value="<?php echo($nama); ?>" required/>
    </div>
    <div class="form-group">
        <label>NIY</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nomor Induk Penguji" name="nuptk" value="<?php echo($nuptk); ?>"/>
    </div>
    <div class="form-group">
        <label>Nama Pengguna (Username)</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Pengguna" name="user" value="<?php echo($user);?>"/>
    </div>
    <div class="form-group">
        <label>Sandi</label>
        <input type="password" class="form-control" placeholder="Silahkan isi dengan Sandi" name="pass" value="<?php echo($pass); ?>"/>
    </div>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Simpan
    </button>
    <button  type="reset" class="btn btn-warning">
        Reset
    </button>
</form>
<br/>
<?php
include ("footer.php");
?> 