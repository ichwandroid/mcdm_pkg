<?php
include ("header.php");
error_reporting(0);
require 'crud.php';
$stmt = viewbobot();
$dafkom = viewdafkomp();
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Daftar Kriteria & Bobot Penilaian</h4></div>
</div>
<br/>
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th width="80px"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($data = mysqli_fetch_assoc($stmt)) {
                ?>
                <tr>
                    <td><?php echo $data['bobot_id'] ?></td>
                    <td><?php echo $dafkom[$i] ?></td>
                    <td><?php 
                        if($data['bobot_nilai'] == '1'){ echo 'Sangat Rendah'; } 
                        else if($data['bobot_nilai'] == '2'){ echo 'Rendah'; } 
                        else if($data['bobot_nilai'] == '3'){ echo 'Cukup'; } 
                        else if($data['bobot_nilai'] == '4'){ echo 'Tinggi'; } 
                        else if($data['bobot_nilai'] == '5'){ echo 'Sangat Tinggi'; } 
                    ?></td>
                    <td align='center'>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a  href="bobot_edit.php?kode=<?php echo $data['bobot_id'] ?>&komp=<?php echo $i ?>" title="Edit" class="btn btn-warning">Ubah</a> 
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
<br/>
<?php
include ("footer.php");
?>