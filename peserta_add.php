<?php
include ("header.php");
require 'crud.php';
$success = "sukses";
$id = "";
$nama = "";
$nuptk = "";
$jk = "";
$instansi = "";
$matpel = "";
$masakerja = "";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nuptk = $_POST['nuptk'];
    $jk = $_POST['jk'];
    $instansi = $_POST['instansi'];
    $matpel = $_POST['matpel'];
    $masakerja = $_POST['masakerja'];
    $success = addpeserta($id, $nama, $nuptk, $jk, $instansi, $matpel, $masakerja);
    if ($success > 0) {
        $id = "";
        $nama = "";
        $jk = "";
        $instansi = "";
        $matpel = "";
        $nuptk = "";
        $masakerja = "";
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
$stmt = viewinstansi();
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi form berikut untuk menambah data peserta</h4></div>
  <div class="col-auto"><a  href="peserta_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>

<form  method="post">
    <div class="form-group">
        <label>ID Peserta</label>
        <input type="text"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo($id); ?>" required/>
    </div>
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Lengkap" name="nama" value="<?php echo($nama); ?>" required/>
    </div>
    <div class="form-group">
        <label>NIY</label>
        <input type="number" class="form-control" placeholder="Silahkan isi dengan NIY" name="nuptk" value="<?php echo($nuptk); ?>"/>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select class="form-control" name="jk">
            <option selected>Pilih Jenis Kelamin</option>
            <option value="1">Laki-laki</option>
            <option value="2">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label>Instansi</label>
        <select class="form-control" name="instansi">
            <option selected>Pilih Instansi</option>
            <?php
                while ($data = mysqli_fetch_assoc($stmt)) {
                ?>
                    <option value="<?php echo $data['instansi_id'] ?>"><?php echo $data['instansi_nama'] ?></option>
                <?php
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Mata Pelajaran</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Mata Pelajaran" name="matpel" value="<?php echo($matpel); ?>"/>
    </div>
    <div class="form-group">
        <label>Masa Kerja (dalam bulan)</label>
        <input type="number" class="form-control" placeholder="Silahkan isi dengan Masa Kerja" name="masakerja" value="<?php echo($masakerja); ?>"/>
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