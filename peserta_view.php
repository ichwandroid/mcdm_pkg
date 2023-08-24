<?php
include ("header.php");
error_reporting(0);
require 'crud.php';
if (isset($_GET['delete'])) {
    deletepeserta($_GET['delete']);
    header("location: peserta_view.php");
}
$stmt = viewpeserta();
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Daftar Peserta</h4></div>
    <div class="col-auto"><a  href="peserta_add.php" class="btn btn-info">Tambah Data</i></a></div>
</div>
<br/>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>NIY</th>
                <th>Jenis Kelamin</th>
                <th>Instansi</th>
                <th>Mata Pelajaran</th>
                <th>Masa Kerja (Bulan)</th>
                <th width="80px"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_assoc($stmt)) {
                ?>
                <tr>
                    <td><?php echo $data['peserta_id'] ?></td>
                    <td><?php echo $data['peserta_nama'] ?></td>
                    <td><?php echo $data['peserta_nuptk'] ?></td>
                    <td>
                        <?php if($data['peserta_jk'] == '1'){ echo 'Laki-laki'; } else { echo 'Perempuan'; } ?>
                    </td>
                    <td><?php echo $data['instansi_nama'] ?></td>
                    <td><?php echo $data['peserta_matpel'] ?></td>
                    <td><?php echo $data['peserta_masa_kerja'] ?></td>
                    <td align='center'>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a  href="peserta_edit.php?kode=<?php echo $data['peserta_id'] ?>" title="Edit" class="btn btn-warning">Ubah</a> 
                            <a  href="peserta_view.php?delete=<?php echo $data['peserta_id'] ?>" title="Hapus" onclick="return confirm('Anda yakin akan menghapus ?');" class="btn btn-danger">Hapus</a>
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