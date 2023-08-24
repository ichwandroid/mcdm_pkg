<?php
include ("header.php");
require 'crud.php';
$tampil = viewpenilaian();
$data      =array();
$kriterias =array();
$bobot     =array();
$setnama =array();
if ($tampil) {
  while($row=$tampil->fetch_object()){
    if(!isset($data[$row->peserta_id])){
      $data[$row->peserta_id]=array();
    }
    if(!isset($data[$row->peserta_id][$row->bobot_id])){
      $data[$row->peserta_id][$row->bobot_id]=array();
    }
    $bobot[$row->bobot_id]=$row->bobot_nilai;
    $data[$row->peserta_id][$row->bobot_id]=$row->nilai;
    $kriterias[]=$row->bobot_id;
    $setnama[$row->peserta_id]=$row->peserta_nama;
  }
}
$kriteria     =array_unique($kriterias);
$jml_kriteria =count($kriteria);
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Perhitungan dengan metode WS</h4></div>
    <div class="col-auto">
        <form  method="post">
            <button  type="submit" class="btn btn-primary" name="kirim">
                Bandingkan hasil
            </button>
        </form>
    </div>
</div>
<br/>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Peserta & Nilai</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan='2'>Alternatif</th>
                    <th colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                </tr>
                <tr>
                    <?php
                    foreach ($kriteria as $k)
                        echo "<th>$k</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $nama => $krit) {
                    echo "<tr>
                      <td>$nama</td>";
                    foreach ($kriteria as $k) {
                        echo "<td align='center'>$krit[$k]</td>";
                    }
                    echo "</tr>\n";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bobot Kriteria</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                </tr>
                <tr>
                    <?php
                    foreach ($kriteria as $k)
                        echo "<th>$k</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                    foreach ($bobot as $k){
                        echo "<td>$k</td>";
                    }
                ?>
                </tr>
            </tbody>
        </table>
        </div>
    </div>    
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Perhitungan</h6>
    </div>
    <div class="card-body">
        <?php
        $maxkriteria = array();
        $tempmax = array();
        for ($n = 1; $n <= $jml_kriteria; $n++){
            $nol = "";
            if($n < 10){
                $nol = "0";
            }
            unset($tempmax);
            foreach ($data as $nama => $krit) {
                $tempmax[]=$krit["C".$nol.$n];
            }
            $maxkriteria["C".$nol.$n]=max($tempmax);
        }
        ?>
        <div class="nav-tabs">
            <ul class="nav nav-tabs">
                <li><a href="#tab_1" class="nav-item nav-link active" data-toggle="tab">Perhitungan Nilai WSM</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <br/><h5 align="center">Hasil Nilai WSM</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan='2'>Alternatif</th>
                                    <th colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                                    <th rowspan='2'>S [Jumlah]</th>
                                </tr>
                                <tr>
                                    <?php
                                    foreach ($kriteria as $k)
                                        echo "<th>$k</th>";
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $hasilws  = array();
                                    $temp = 0;
                                    $i = 0;
                                    foreach ($data as $nama => $krit) {
                                    echo "<tr><td>".$nama."</td>";
                                        $temp = 0;
                                        foreach ($kriteria as $k) {
                                        $temps = $krit[$k] * $bobot[$k];
                                        $temp = $temp + $temps;
                                        echo "<td><div class='text-xs'> alt ".$nama." * bobot ".$k." =</div>".round(($temps), 4)."</td>";
                                        }
                                        $hasilws[$nama] = $temp;
                                        echo "<td><b>".round(($temp), 4)."</b></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Hasil Perangkingan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nama Peserta</th>
                    <th>Nilai WS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                arsort($hasilws);
                foreach($hasilws as $x=>$x_value) {
                    echo "<tr>
                      <td>" . (++$i) . "</td>
                      <td>{$x}</td>
                      <td>$setnama[$x]</td>
                      <td>".round(($x_value), 4)."</td>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['kirim'])) {
        $meode = "wsm";
        foreach($hasilws as $x=>$x_value) {
            $succes = addsimpanhasil($x, $meode, $x_value);
         }
         header('Location: mcdm_wpm.php');
    }
?>
<?php
include ("footer.php");
?>