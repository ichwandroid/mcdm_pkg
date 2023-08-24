<?php
ob_start();
include ("header.php");
require 'crud.php';
$success = "sukses";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['notelp'];
    $pimpinan = $_POST['pimpinan'];
    $nuptk = $_POST['nuptk'];
    $success = updateinstansi($id, $nama, $alamat, $notelp, $pimpinan, $nuptk);
    if ($success > 0) {
        header('Location: instansi_view.php');
    } else {
        echo' <div class="alert alert-danger" role="alert">
            <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
        </div>';
    }
}
$book = ambileditinstansi($_GET['kode']);
$edit = mysqli_fetch_assoc($book);
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi untuk mengubah data instansi dengan ID :<?php echo $edit['instansi_id']; ?></h4></div>
  <div class="col-auto"><a  href="instansi_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<form  method="post">
    <input type="hidden"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo $edit['instansi_id']; ?>" />
    <div class="form-group">
        <label>Nama Instansi</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Instansi" name="nama" value="<?php echo $edit['instansi_nama']; ?>" required/>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan alamat" name="alamat" value="<?php echo $edit['instansi_alamat']; ?>"/>
    </div>
    <div class="form-group">
        <label>Nomor Telepon</label>
        <input type="number" class="form-control" placeholder="Silahkan isi dengan momor telepon" name="notelp" value="<?php echo $edit['instansi_notelp']; ?>"/>
    </div>
    <div class="form-group">
        <label>Pimpinan</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Pimpinan Instansi" name="pimpinan" value="<?php echo $edit['instansi_pimpinan']; ?>"/>
    </div>
    <div class="form-group">
        <label>NIY Pimpinan</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan NUPTK Pimpinan" name="nuptk" value="<?php echo $edit['instansi_pimpinannuptk']; ?>"/>
    </div>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Ubah
    </button>
</form>
<br/>
<?php
include ("footer.php");
?> 