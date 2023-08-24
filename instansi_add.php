<?php
include ("header.php");
require 'crud.php';
$success = "sukses";
$id = "";
$nama = "";
$alamat = "";
$notelp = "";
$pimpinan = "";
$nuptk = "";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['notelp'];
    $pimpinan = $_POST['pimpinan'];
    $nuptk = $_POST['nuptk'];
    $success = addinstansi($id, $nama, $alamat, $notelp, $pimpinan, $nuptk);
    if ($success > 0) {
        $id = "";
        $nama = "";
        $alamat = "";
        $notelp = "";
        $pimpinan = "";
        $nuptk = "";
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
  <div class="col-auto mr-auto"><h4>Silahkah isi form berikut untuk menambah instansi</h4></div>
  <div class="col-auto"><a  href="instansi_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>

<form  method="post">
    <div class="form-group">
        <label>ID</label>
        <input type="text"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo($id); ?>" required/>
    </div>
    <div class="form-group">
        <label>Nama Instansi</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Instansi" name="nama" value="<?php echo($nama); ?>" required/>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan alamat Instansi" name="alamat" value="<?php echo($alamat); ?>"/>
    </div>
    <div class="form-group">
        <label>Nomor Telepon</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nomor Telepon Instansi" name="notelp" value="<?php echo($notelp); ?>"/>
    </div>
    <div class="form-group">
        <label>Pimpinan</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Pimpinan" name="pimpinan" value="<?php echo($pimpinan); ?>"/>
    </div>
    <div class="form-group">
        <label>NIY Pimpinan</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nomor Induk Pimpinan" name="nuptk" value="<?php echo($nuptk); ?>"/>
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