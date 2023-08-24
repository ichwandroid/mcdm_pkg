<?php
include ("header.php");
error_reporting(0);
require 'crud.php';
if (isset($_GET['delete'])) {
    deletepenguji($_GET['delete']);
    header("location: penguji_view.php");
}
$stmt = viewpenguji();
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Daftar Penguji</h4></div>
    <div class="col-auto"><a  href="penguji_add.php" class="btn btn-info">Tambah Data</i></a></div>
</div>
<br/>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIY</th>
                <th width="80px"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_assoc($stmt)) {
                ?>
                <tr>
                    <td><?php echo $data['penguji_id'] ?></td>
                    <td><?php echo $data['penguji_nama'] ?></td>
                    <td><?php echo $data['penguji_nuptk'] ?></td>
                    <td align='center'>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a  href="penguji_edit.php?kode=<?php echo $data['penguji_id'] ?>" title="Edit" class="btn btn-warning">Ubah</a> 
                            <a  href="penguji_view.php?delete=<?php echo $data['penguji_id'] ?>" title="Hapus" onclick="return confirm('Anda yakin akan menghapus ?');" class="btn btn-danger">Hapus</a>
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