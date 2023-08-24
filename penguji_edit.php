<?php
ob_start();
include ("header.php");
require 'crud.php';
$success = "sukses";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nuptk = $_POST['nuptk'];
    $success = updatepenguji($id, $nama, $nuptk);
    if ($success > 0) {
        header('Location: penguji_view.php');
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}
$book = ambileditpenguji($_GET['kode']);
$edit = mysqli_fetch_assoc($book);
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi untuk mengubah data penguji dengan ID :<?php echo $edit['penguji_id']; ?></h4></div>
  <div class="col-auto"><a  href="penguji_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<form  method="post">
    <input type="hidden"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo $edit['penguji_id']; ?>" />
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Penguji" name="nama" value="<?php echo $edit['penguji_nama']; ?>" required/>
    </div>
    <div class="form-group">
        <label>NIY</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan NUPTK Penguji" name="nuptk" value="<?php echo $edit['penguji_nuptk']; ?>"/>
    </div>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Ubah
    </button>
</form>
<br/>
<?php
include ("footer.php");
?> 