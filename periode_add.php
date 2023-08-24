<?php
include ("header.php");
require 'crud.php';
$success = "sukses";
$id = "";
$awal = "";
$akhir = "";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $success = addperiode($id, $awal, $akhir);
    if ($success > 0) {
        $id = "";
        $awal = "";
        $akhir = "";
        echo' <div class="alert alert-success" role="alert">
            <strong>Sukses</strong>, data telah berhasil diinputkan.
        </div>';
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi form berikut untuk menambah periode penilaian</h4></div>
  <div class="col-auto"><a  href="periode_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<form  method="post">
    <div class="form-group">
        <label>ID</label>
        <input type="text"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo($id); ?>" required/>
    </div>
    <div class="form-group">
        <label>Tanggal Awal Periode</label>
        <input type="date" class="form-control" name="awal" value="<?php echo($awal); ?>" required/>
    </div>
    <div class="form-group">
        <label>Tanggal Akhir Periode</label>
        <input type="date" class="form-control" name="akhir" value="<?php echo($akhir); ?>"/>
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