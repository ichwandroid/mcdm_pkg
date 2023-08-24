<?php
include("header.php");
error_reporting(0);
require 'crud.php';
if (isset($_GET['delete'])) {
    deleteperiode($_GET['delete']);
    header("location: periode_view.php");
}
$stmt = viewperiode();
?>
<div class="row">
    <div class="col-auto mr-auto">
        <h4>Daftar Periode Penilaian</h4>
    </div>
    <div class="col-auto"><a href="periode_add.php" class="btn btn-info">Tambah Data</i></a></div>
</div>
<br />
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Periode Penilaian</th>
                <th width="80px"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_assoc($stmt)) {
            ?>
                <tr>
                    <td><?php echo $data['periode_id'] ?></td>
                    <td><?php echo $data['periode_tglawal'] ?> sampai dengan <?php echo $data['periode_tglakhir'] ?></td>
                    <td align='center'>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="laporan.php?kode=<?php echo $data['periode_id'] ?>" title="Cetak" class="btn btn-success">Cetak</a>
                            <a href="periode_view.php?delete=<?php echo $data['periode_id'] ?>" title="Hapus" onclick="return confirm('Anda yakin akan menghapus ?');" class="btn btn-danger">Hapus</a>
                        </div>
                    </td>
                </tr>
            <?php
            };
            ?>
        </tbody>
    </table>
</div>
<br />
<?php
include("footer.php");
?>