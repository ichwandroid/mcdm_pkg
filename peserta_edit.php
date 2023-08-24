<?php
ob_start();
include ("header.php");
require 'crud.php';
$success = "sukses";
if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nuptk = $_POST['nuptk'];
    $jk = $_POST['jk'];
    $instansi = $_POST['instansi'];
    $matpel = $_POST['matpel'];
    $masakerja = $_POST['masakerja'];
    $success = updatepeserta($id, $nama, $nuptk, $jk, $instansi, $matpel, $masakerja);
    if ($success > 0) {
        header('Location: peserta_view.php');
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}
$book = ambileditpeserta($_GET['kode']);
$edit = mysqli_fetch_assoc($book);
$stmt = viewinstansi();
?>
<div class="row">
  <div class="col-auto mr-auto"><h4>Silahkah isi untuk mengubah data peserta dengan ID :<?php echo $edit['peserta_id']; ?></h4></div>
  <div class="col-auto"><a  href="peserta_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<form  method="post">
    <div class="form-group">
        <label>ID Peserta</label>
        <input type="text"  class="form-control" placeholder="Silahkan isi dengan ID" name="id" value="<?php echo $edit['peserta_id']; ?>" disabled/>
        <input type="hidden"  name="id" value="<?php echo $edit['peserta_id']; ?>"/>
    </div>
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Nama Lengkap" name="nama" value="<?php echo $edit['peserta_nama']; ?>" required/>
    </div>
    <div class="form-group">
        <label>NIY</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan NIY" name="nuptk" value="<?php echo $edit['peserta_nuptk']; ?>"/>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select class="form-control" name="jk">
            <option value="1" <?php if($edit['peserta_jk'] == '1'){ echo 'selected'; } ?>>Laki-laki</option>
            <option value="2" <?php if($edit['peserta_jk'] == '2'){ echo 'selected'; } ?>>Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label>Instansi</label>
        <select class="form-control" name="instansi">
            <option selected>Pilih Instansi</option>
            <?php
                while ($data = mysqli_fetch_assoc($stmt)) {
                ?>
                    <option value="<?php echo $data['instansi_id'] ?>" <?php if($edit['peserta_instansi'] == $data['instansi_id']){ echo 'selected'; } ?>><?php echo $data['instansi_nama'] ?></option>
                <?php
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Mata Pelajaran</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Mata Pelajaran" name="matpel" value="<?php echo $edit['peserta_matpel']; ?>"/>
    </div>
    <div class="form-group">
        <label>Masa Kerja (dalam bulan)</label>
        <input type="text" class="form-control" placeholder="Silahkan isi dengan Masa Kerja" name="masakerja" value="<?php echo $edit['peserta_masa_kerja']; ?>"/>
    </div>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Ubah
    </button>
</form>
<br/>
<?php
include ("footer.php");
?> 