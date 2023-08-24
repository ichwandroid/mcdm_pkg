<?php
include ("header.php");
require 'crud.php';
require 'mcdm_ahp_proses.php';
$tampil = viewpenilaianahp();
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
    $bobot[$row->bobot_id]=$row->bobot_ahp;
    $data[$row->peserta_id][$row->bobot_id]=$row->nilai;
    $kriterias[]=$row->bobot_id;
    $setnama[$row->peserta_id]=$row->peserta_nama;
  }
}
$kriteria     =array_unique($kriterias);
$jml_kriteria =count($kriteria);
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Perhitungan dengan metode AHP</h4></div>
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
                        echo "<th>$k</th>\n";
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
        <div class="nav-tabs">
            <ul class="nav nav-tabs">
                <li><a href="#tab_krit" class="nav-item nav-link active" data-toggle="tab">Kriteria</a></li>
                <li><a href="#tab_kritnilai" class="nav-item nav-link" data-toggle="tab">Nilai Kriteria</a></li>
                <li><a href="#tab_hsl" class="nav-item nav-link" data-toggle="tab">Hasil</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_krit">
                    <br/><h5 align="center">Perhitungan Kriteria</h5>
                    <?php
                    $tampil2 = hitung_ahp($bobot, $jml_kriteria, "kriteria", "K");
                    ?>
                </div>
                <div class="tab-pane" id="tab_kritnilai">
                    <br/><h5 align="center">Perhitungan Nilai Kriteria</h5>
                    <?php
                    $arraykn = array();
                    $nkn = 0;
                    for ($n = 1; $n <= 4; $n++){
                        $arraykn[$n] = $nkn;
                        $nkn = $nkn + 2;
                    }
                    $tampilkn2 = hitung_ahp($arraykn, '4', "kriteria", "N");
                    ?>
                </div>
                <div class="tab-pane" id="tab_hsl">
                    <br/><h5 align="center">Hasil Perhitungan</h5>
                    <?php
                        // echo "tampilkn2";
                        // print_r($tampilkn2);
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan='2'>Alternatif</th>
                                    <th colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                                    <th rowspan='2'>Hasil</th>
                                </tr>
                                <tr>
                                    <?php
                                    foreach ($kriteria as $k)
                                        echo "<th>$k</th>\n";
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $hasilfinal = array();
                                foreach ($data as $nama => $krit) {
                                    echo "<tr><td>$nama</td>";
                                    $temp = 0;
                                    foreach ($kriteria as $k) {
                                        $temptemp = $tampilkn2[$krit[$k]] * $tampil2[$k];
                                        $temp = $temp + ($temptemp);
                                        echo "<td><div class='text-xs'>rata2 [" . $krit[$k] . "] * rata2 [" . $k . "] =</div>" . round($temptemp, 4) . "</td>";
                                    }
                                    $hasilfinal[$nama] = $temp;
                                    echo "<td><b>" . round($temp, 4) . "<b></td></tr>";
                                }
                                // foreach ($arraytemp3 as $k => $a) {
                                //     echo "<tr><td>" . $k . "</td>";
                                //     $temp = 0;
                                //     foreach ($a as $iii => $iiii) {
                                //         $temptemp = $iiii * $tampil2[$iii];
                                //         $temp = $temp + ($temptemp);
                                //         echo "<td><div class='text-xs'>rata2 [" . $iii . "] * rata2 [" . $k . "] =</div>" . round($temptemp, 4) . "</td>";
                                //     }
                                //     $hasilfinal[$k] = round($temp, 4);
                                //     echo "<td><b>" . round($temp, 4) . "<b></td></tr>";
                                // }
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
                    <th>Nilai AHP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                arsort($hasilfinal);
                foreach($hasilfinal as $x=>$x_value) {
                   echo "<tr>
                    <td>" . (++$i) . "</td>
                     <td>{$x}</td>
                     <td>$setnama[$x]</td>
                     <td>".round($x_value,4)."</td>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['kirim'])) {
        $meode = "AHP";
        deletesimpanhasil();
        foreach($hasilfinal as $x=>$x_value) {
            $succes = addsimpanhasil($x, $meode, $x_value);
         }
         header('Location: mcdm_wsm.php');
    }
?>
<?php
include ("footer.php");
?>