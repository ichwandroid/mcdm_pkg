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
    <div class="col-auto mr-auto"><h4>Perhitungan dengan metode WP</h4></div>
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
                <li><a href="#tab_1" class="nav-item nav-link active" data-toggle="tab">Normalisasi Bobot</a></li>
                <li><a href="#tab_2" class="nav-item nav-link" data-toggle="tab">Vektor S</a></li>
                <li><a href="#tab_3" class="nav-item nav-link" data-toggle="tab">Vektor V</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <br/><h5 align="center">Normalisasi Bobot</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan='2'>Normalisasi</th>
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
                                <td>Bobot Awal</td>
                                <?php
                                    $jumlahbobot = 0;
                                    foreach ($bobot as $k){
                                        echo "<td>$k</td>";
                                        $jumlahbobot = $jumlahbobot + $k; 
                                    }
                                ?>
                                </tr>
                                <tr>
                                <td>Bobot Normalisasi <div class='text-xs'><?php echo "Jml: ".$jumlahbobot?></td>
                                <?php
                                    $bobotbaru =array();
                                    $i = 0;
                                    foreach ($bobot as $k){
                                        (++$i);
                                        $nol = "";
                                        if($i < 10){
                                            $nol = "0";
                                        }
                                        $temps  = $k / $jumlahbobot;
                                        $bobotbaru[] = $temps;
                                        echo "<td><div class='text-xs'>C".$nol.$i." / jml =</div>".round(($temps), 4)."</td>";
                                    }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <br/><h5 align="center">Vektor S</h5>
                    <?php
                        $vektor_s = Array();
                        foreach ($data as $nama => $krit) {
                                $i = 0;
                                foreach ($kriteria as $k) {
                                    $vektor_s[$nama][$k] = pow($krit[$k],$bobotbaru[$i]);
                                    ++$i;
                                }
                        }
                        $jml_vektor_s = Array();
                        $total_vs = 0;
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th rowspan='2'>Alternatif</th>
                                    <th colspan='<?php echo $jml_kriteria; ?>'>Kriteria</th>
                                    <th rowspan='2'>S <div class='text-xs'>[hasil perkalian]</div></th>
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
                                        echo "<tr><td>".$nama."</td>";
                                            $tempvs = 1;
                                            foreach ($kriteria as $k) {
                                                echo "<td><div class='text-xs'>".$nama."^".$k." =</div>".round($vektor_s[$nama][$k], 4)."</td>";
                                                $tempvs = ($tempvs * $vektor_s[$nama][$k]);
                                            }
                                            echo "<td><b>".round($tempvs, 4)."</b></td></tr>";
                                            $jml_vektor_s[$nama] = $tempvs;
                                            $total_vs = $total_vs + $tempvs;
                                    }
                                ?>
                                <tr>
                                    <td colspan='<?php echo ($jml_kriteria+1);?>'><b>Jumlah S</b></td>
                                    <td><b><?php echo round($total_vs,4);?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <br/><h5 align="center">Vektor V</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th>V</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $vektor_v = Array();
                                    foreach ($data as $nama => $krit) {
                                    echo '<tr><td>'.$nama.'</td>';
                                    $temps = ($jml_vektor_s[$nama]/$total_vs);
                                    $vektor_v[$nama] = $temps;
                                    echo "<td><div class='text-xs'> s ".$nama."/ jumlah s =</div><b>".round($temps, 4)."</b></td></tr>";
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
                    <th>Nilai WP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                arsort($vektor_v);
                foreach($vektor_v as $x=>$x_value) {
                    echo "<tr>
                      <td>" . (++$i) . "</td>
                      <td>{$x}</td>
                      <td>$setnama[$x]</td>
                      <td>".round($x_value, 4)."</td>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['kirim'])) {
        $meode = "wpm";
        foreach($vektor_v as $x=>$x_value) {
            $succes = addsimpanhasil($x, $meode, $x_value);
         }
         header('Location: mcdm_topsis.php');
    }
?>
<?php
include ("footer.php");
?>