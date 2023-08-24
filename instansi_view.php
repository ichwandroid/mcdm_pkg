<?php
include ("header.php");
error_reporting(0);
require 'crud.php';
if (isset($_GET['delete'])) {
    deleteinstansi($_GET['delete']);
    header("location: instansi_view.php");
}
$stmt = viewinstansi();
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Daftar Instansi</h4></div>
    <div class="col-auto"><a  href="instansi_add.php" class="btn btn-info">Tambah Data</i></a></div>
</div>
<br/>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Instansi</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Pimpinan</th>
                <th>NIY Pimpinan</th>
                <th width="80px"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_assoc($stmt)) {
                ?>
                <tr>
                    <td><?php echo $data['instansi_id'] ?></td>
                    <td><?php echo $data['instansi_nama'] ?></td>
                    <td><?php echo $data['instansi_alamat'] ?></td>
                    <td><?php echo $data['instansi_notelp'] ?></td>
                    <td><?php echo $data['instansi_pimpinan'] ?></td>
                    <td><?php echo $data['instansi_pimpinannuptk'] ?></td>
                    <td align='center'>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a  href="instansi_edit.php?kode=<?php echo $data['instansi_id'] ?>" title="Edit" class="btn btn-warning">Ubah</a> 
                            <a  href="instansi_view.php?delete=<?php echo $data['instansi_id'] ?>" title="Hapus" onclick="return confirm('Anda yakin akan menghapus ?');" class="btn btn-danger">Hapus</a>
                        </div>
                    </td>    
                </tr>
                <?php
            };
            ?>
        </tbody>
    </table>
</div>
<br/>
<?php
include ("footer.php");
?>