<?php
include ("header.php");
error_reporting(0);
require 'crud.php';
$stmt  = viewsimpanhasil("AHP");
$stmt1 = viewsimpanhasil("wsm");
$stmt2 = viewsimpanhasil("wpm");
$stmt3 = viewsimpanhasil("topsis");
$stmt4 = viewnilaidetailperangkingan();
$simpan_hsl_ahp = array();
$simpan_hsl_wsm = array();
$simpan_hsl_wpm = array();
$simpan_hsl_topsis = array();
$simpan_hsl_manual = array();
$simpan_n_manual = array();
$i = 0;
while ($data2 = mysqli_fetch_assoc($stmt)) {
    $simpan_hsl_ahp[$i] = $data2['id_peserta'];
    $i++;
};
$i = 0;
while ($data2 = mysqli_fetch_assoc($stmt1)) {
    $simpan_hsl_wsm[$i] = $data2['id_peserta'];
    $i++;
};
$i = 0;
while ($data2 = mysqli_fetch_assoc($stmt2)) {
    $simpan_hsl_wpm[$i] = $data2['id_peserta'];
    $i++;
};
$i = 0;
while ($data2 = mysqli_fetch_assoc($stmt3)) {
    $simpan_hsl_topsis[$i] = $data2['id_peserta'];
    $i++;
};
$i = 0;
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
    $simpan_hsl_manual[$i] = $data2['detail_peserta'];
    $simpan_n_manual[$data2['detail_peserta']] = $ranking;
    $i++;
};
$tdksama_ahp = 0;
$tdksama_wsm = 0;
$tdksama_wpm = 0;
$tdksama_topsis = 0;
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Perbandingan Hasil Perangkingan</h4></div>
</div>
<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Manual</th>
                <th>AHP</th>
                <th>WSM</th>
                <th>WPM</th>
                <th>TOPSIS</th>
            </tr>
        </thead>            
        <tbody>
           <?php 
                for($ff=0; $ff < count($simpan_hsl_manual); $ff++){
                    echo "<tr>";
                        echo "<td>".($ff+1)."</td>";
                        echo "<td>".$simpan_hsl_manual[$ff]."(".$simpan_n_manual[$simpan_hsl_manual[$ff]].")</td>";
                        $tdksama_ahp = $tdksama_ahp + perbandingan($simpan_hsl_ahp[$ff], $simpan_hsl_manual[$ff], $simpan_n_manual);
                        $tdksama_wsm = $tdksama_wsm + perbandingan($simpan_hsl_wsm[$ff], $simpan_hsl_manual[$ff], $simpan_n_manual);
                        $tdksama_wpm = $tdksama_wpm + perbandingan($simpan_hsl_wpm[$ff], $simpan_hsl_manual[$ff], $simpan_n_manual);
                        $tdksama_topsis = $tdksama_topsis + perbandingan($simpan_hsl_topsis[$ff], $simpan_hsl_manual[$ff], $simpan_n_manual);
                    echo "</tr>";
                }
                echo "<tr>";
                    echo "<th colspan=2>Nilai Hamming Distance</th>";
                    // echo "<th>".$tdksama_ahp."(".($tdksama_ahp/25*100)."%)</th>";
                    // echo "<th>".$tdksama_wsm."(".($tdksama_wsm/25*100)."%)</th>";
                    // echo "<th>".$tdksama_wpm."(".($tdksama_wpm/25*100)."%)</th>";
                    // echo "<th>".$tdksama_topsis."(".($tdksama_topsis/25*100)."%)</th>";
                    echo "<th>".$tdksama_ahp."</th>";
                    echo "<th>".$tdksama_wsm."</th>";
                    echo "<th>".$tdksama_wpm."</th>";
                    echo "<th>".$tdksama_topsis."</th>";
                echo "</tr>";
           ?>
        </tbody>      
    </table>
</div>
<br/>
<?php
include ("footer.php");
?>