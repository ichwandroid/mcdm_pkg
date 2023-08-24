<?php
include ("header.php");
error_reporting(0);
require 'crud.php';
if (isset($_GET['deldetni'])) { 
    deleteinilaidetail($_GET['deldetni']);
    deletenilai($_GET['delni']);
    header("location: penilaian_view.php");
}
$stmt = viewnilaidetail();
$stmt4 = viewnilaidetailperangkinganb();
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Data Penilaian</h4></div>
    <div class="col-auto"><a  href="penilaian_add.php" class="btn btn-info">Tambah Data</i></a></div>
    <div class="col-auto"><a  href="penilaian_otomatis.php" class="btn btn-info">Buat Data Dummy</i></a></div>
</div>
<br/>
<div class="table-responsive">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data</h6>
    </div>
    <div class="card-body">
        <div class="nav-tabs">
            <ul class="nav nav-tabs">
                <li><a href="#tab_perni" class="nav-item nav-link active" data-toggle="tab">Penilaian</a></li>
                <li><a href="#tab_pernirang" class="nav-item nav-link" data-toggle="tab">Perangkingan</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_perni">
                    <br/><h5 align="center">Penilaian</h5>
					
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>ID Peserta</th>
								<th>NIY</th>
								<th>Nama</th>
								<th>Instansi</th>
								<th>Penguji</th>
								<th>Periode Penilaian</th>
								<th>Nilai</th>
								<th width="80px"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							while ($data = mysqli_fetch_assoc($stmt)) {
								?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $data['detail_peserta'] ?></td>
									<td><?php echo $data['peserta_nuptk'] ?></td>
									<td><?php echo $data['peserta_nama'] ?></td>
									<td><?php echo $data['instansi_nama'] ?></td>
									<td><?php echo $data['penguji_nama'] ?></td>
									<td><?php echo $data['periode_tglawal']." - ". $data['periode_tglakhir']?></td>
									<td><?php echo $data['total'] ?></td>
									<td align='center'>
										<div class="btn-group" role="group" aria-label="Basic mixed styles example">
											<a  href="penilaian_lht.php?kode=<?php echo $data['detail_id'] ?>" title="Detail" class="btn btn-success">Detail</a> 
											<a  href="penilaian_edit.php?kode=<?php echo $data['detail_id'] ?>" title="Edit" class="btn btn-warning">Ubah</a> 
											<a  href="penilaian_view.php?deldetni=<?php echo $data['detail_id'] ?>&delni=<?php echo $data['detail_peserta'] ?>" title="Hapus" onclick="return confirm('Anda yakin akan menghapus ?');" class="btn btn-danger">Hapus</a>
										</div>
									</td>    
								</tr>
								<?php
								$i++;
							};
							?>
						</tbody>
					</table>
                    
                </div>
                <div class="tab-pane" id="tab_pernirang">
                    <br/><h5 align="center">Perangkingan</h5>
					
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>ID Peserta</th>
								<th>Nama</th>
								<th>Nilai</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$ranking = 1 ;
							$perban = -1;
							while ($data2 = mysqli_fetch_assoc($stmt4)) {
								if($perban == -1){
									$perban = $data2['total'];
								}
								if($perban != $data2['total']){
									$ranking = $i+1;
									$perban = $data2['total'];
								}
								?>
								
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $data2['detail_peserta']." (".$ranking.")" ?></td>
									<td><?php echo $data2['peserta_nama'] ?></td>
									<td><?php echo $data2['total'] ?></td>
								</tr>
								<?php
								$i++;
							};
							?>
						</tbody>
					</table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

	
	
	
	
	
</div>
<br/>
<?php
include ("footer.php");
?>