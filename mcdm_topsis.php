<?php
include ("header.php");
require 'crud.php';
$tampil = viewpenilaian();
$data      =array();
$kriterias =array();
$bobot     =array();
$nilai_kuadrat =array();
$setnama =array();
if ($tampil) {
  while($row=$tampil->fetch_object()){
    if(!isset($data[$row->peserta_id])){
      $data[$row->peserta_id]=array();
    }
    if(!isset($data[$row->peserta_id][$row->bobot_id])){
      $data[$row->peserta_id][$row->bobot_id]=array();
    }
    if(!isset($nilai_kuadrat[$row->bobot_id])){
      $nilai_kuadrat[$row->bobot_id]=0;
    }
    $bobot[$row->bobot_id]=$row->bobot_nilai;
    $data[$row->peserta_id][$row->bobot_id]=$row->nilai;
    $nilai_kuadrat[$row->bobot_id]+=pow($row->nilai,2);
    $kriterias[]=$row->bobot_id;
    $setnama[$row->peserta_id]=$row->peserta_nama;
  }
}
$kriteria     =array_unique($kriterias);
$jml_kriteria =count($kriteria);
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Perhitungan dengan metode TOPSIS</h4></div>
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
                <tr>
                <?php
                    foreach ($bobot as $k){
                        echo "<td>Benefit</td>";
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
                <li><a href="#tab_1" class="nav-item nav-link active" data-toggle="tab">Normalisasi Alternatif</a></li>
                <li><a href="#tab_2" class="nav-item nav-link" data-toggle="tab">Ideal positif</a></li>
                <li><a href="#tab_3" class="nav-item nav-link" data-toggle="tab">Ideal negatif</a></li>
                <li><a href="#tab_4" class="nav-item nav-link" data-toggle="tab">Jarak positif</a></li>
                <li><a href="#tab_5" class="nav-item nav-link" data-toggle="tab">Jarak negatif</a></li>
                <li><a href="#tab_6" class="nav-item nav-link" data-toggle="tab">Nilai Preferensi (V)</a></li>                
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <br/><h5 align="center">Normalisasi Alternatif (y<sub>ij</sub>)</h5>  
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan='3'>Alternatif</th>
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
                                $i = 0;
                                $y = array();
                                foreach ($data as $nama => $krit) {
                                    (++$i);
                                    echo "<tr>
                                    <td>{$nama}</td>";
                                    foreach ($kriteria as $k) {
                                        $y[$k][$i - 1] = round(($krit[$k] / sqrt($nilai_kuadrat[$k])), 4) * $bobot[$k];
                                        echo "<td align='center'>" . $y[$k][$i - 1] . "</td>";
                                    }
                                    echo
                                    "</tr>\n";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <br/><h5 align="center">Solusi Ideal positif (A<sup>+</sup>)</h5>  
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
                                <tr>
                                    <?php
                                    for ($n = 1; $n <= $jml_kriteria; $n++)
                                        echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $yplus = array();
                                    foreach ($kriteria as $k) {
                                        $yplus[$k] = ([$k] ? max($y[$k]) : min($y[$k]));
                                        echo "<td>$yplus[$k]</td>";
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>                  
                </div>
                <div class="tab-pane" id="tab_3">
                    <br/><h5 align="center">Solusi Ideal negatif (A<sup>-</sup>)</h5>  
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                                </tr>
                                <tr>
                                    <?php
                                    foreach ($kriteria as $k)
                                        echo "<th>{$k}</th>";
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    for ($n = 1; $n <= $jml_kriteria; $n++)
                                        echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $ymin = array();
                                    foreach ($kriteria as $k) {
                                        $ymin[$k] = [$k] ? min($y[$k]) : max($y[$k]);
                                        echo "<td>{$ymin[$k]}</td>";
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>                  
                </div>
                <div class="tab-pane" id="tab_4">
                    <br/><h5 align="center">Jarak positif (D<sub>i</sub><sup>+</sup>)</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th>D<suo>+</sup></th>
                                </tr>
                                </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $dplus = array();
                                foreach ($data as $nama => $krit) {
                                    (++$i);
                                    echo "<tr>
                                    <td>{$nama}</td>";
                                        foreach ($kriteria as $k) {
                                            if (!isset($dplus[$i - 1]))
                                                $dplus[$i - 1] = 0;
                                                $dplus[$i - 1] += pow($yplus[$k] - $y[$k][$i - 1], 2);
                                        }
                                        echo "<td>" . round(sqrt($dplus[$i - 1]), 6) . "</td>
                                    </tr>\n";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
                <div class="tab-pane" id="tab_5">
                    <br/><h5 align="center">Jarak negatif (D<sub>i</sub><sup>-</sup>)</h5>
                    <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Alternatif</th>
                                <th>D<suo>-</sup></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $dmin = array();
                            foreach ($data as $nama => $krit) {
                                (++$i);
                                echo "<tr>
                                <td>{$nama}</td>";
                                    foreach ($kriteria as $k) {
                                        if (!isset($dmin[$i - 1]))
                                            $dmin[$i - 1] = 0;
                                            $dmin[$i - 1] += pow($ymin[$k] - $y[$k][$i - 1], 2);
                                        }
                                    echo "<td>" . round(sqrt($dmin[$i - 1]), 6) . "</td>
                                </tr>\n";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>                    
                </div>
                <div class="tab-pane" id="tab_6">
                    <br/><h5 align="center">Nilai Preferensi(V<sub>i</sub>)</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0"><div class="panel panel-default">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th>V<sub>i</sub></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $V = array();
                                $hasiltopsis = array();
                                foreach ($data as $nama => $krit) {
                                    (++$i);
                                    echo "<tr>
                                    <td>{$nama}</td>";
                                    foreach ($kriteria as $k) {
                                        $V[$i - 1] = round(sqrt($dmin[$i - 1]) / (sqrt($dmin[$i - 1]) + sqrt($dplus[$i - 1])), 4);
                                    }
                                    echo "<td>{$V[$i - 1]}</td></tr>\n";
                                    $hasiltopsis[$nama]=$V[$i - 1];
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
                    <th>Nilai Topsis</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                arsort($hasiltopsis);
                foreach($hasiltopsis as $x=>$x_value) {
                    echo "<tr>
                      <td>" . (++$i) . "</td>
                      <td>{$x}</td>
                      <td>$setnama[$x]</td>
                      <td>{$x_value}</td>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['kirim'])) {
        $meode = "topsis";
        foreach($hasiltopsis as $x=>$x_value) {
            $succes = addsimpanhasil($x, $meode, $x_value);
         }
         header('Location: perbandingan.php');
    }
?>
<?php
include ("footer.php");
?>