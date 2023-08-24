<?php
ob_start();
include ("header.php");
require 'crud.php';
$success = "sukses";
$book = ambileditnilaidetail($_GET['kode']);
$edit = mysqli_fetch_assoc($book);
$stmt = viewpeserta();
$stmt2 = viewpenguji();
$stmt3 = viewperiode();
$kompkomp = viewpoinkomp();
$kompetensititle = viewdafkomp();
$simpanjumlahskor = array();
$simpanpersenkomp = array();
$simpanakhirkomp = array();
$simpantiti2 = [0, 6, 12, 16, 27, 34, 40, 45, 50, 55, 63, 66, 69, 72, 78];
$detail_id = $edit['detail_id'];
$detail_peserta = $edit['detail_peserta'];
$detail_penguji = $edit['detail_penguji'];
$detail_periode = $edit['detail_periode'];
$simpannilaipoinkomp = [$edit['K0101'], $edit['K0102'], $edit['K0103'], $edit['K0104'], $edit['K0105'], $edit['K0106'],
    $edit['K0201'], $edit['K0202'], $edit['K0203'], $edit['K0204'], $edit['K0205'], $edit['K0206'],
    $edit['K0301'], $edit['K0302'], $edit['K0303'], $edit['K0304'],
    $edit['K0401'], $edit['K0402'], $edit['K0403'], $edit['K0404'], $edit['K0405'], $edit['K0406'], $edit['K0407'], $edit['K0408'], $edit['K0409'], $edit['K0410'], $edit['K0411'],
    $edit['K0501'], $edit['K0502'], $edit['K0503'], $edit['K0504'], $edit['K0505'], $edit['K0506'], $edit['K0507'],
    $edit['K0601'], $edit['K0602'], $edit['K0603'], $edit['K0604'], $edit['K0605'], $edit['K0606'],
    $edit['K0701'], $edit['K0702'], $edit['K0703'], $edit['K0704'], $edit['K0705'],
    $edit['K0801'], $edit['K0802'], $edit['K0803'], $edit['K0804'], $edit['K0805'],
    $edit['K0901'], $edit['K0902'], $edit['K0903'], $edit['K0904'], $edit['K0905'],
    $edit['K1001'], $edit['K1002'], $edit['K1003'], $edit['K1004'], $edit['K1005'], $edit['K1006'], $edit['K1007'], $edit['K1008'],
    $edit['K1101'], $edit['K1102'], $edit['K1103'],
    $edit['K1201'], $edit['K1202'], $edit['K1203'],
    $edit['K1301'], $edit['K1302'], $edit['K1303'],
    $edit['K1401'], $edit['K1402'], $edit['K1403'], $edit['K1404'], $edit['K1405'], $edit['K1406']];
$total = 0;
$ttkawal = 0;
$ttkakhir = 1;
$i = 0;
for ($ff = 0; $ff < (count($simpantiti2) - 1); $ff++) {
    $temp = 0;
    for ($f = $simpantiti2[$ttkawal]; $f < $simpantiti2[$ttkakhir]; $f++) {
        $temp = $temp + $simpannilaipoinkomp[$f];
    }
    $simpanjumlahskor[$i] = $temp;
    $simpanpersenkomp[$i] = round((($temp / (($simpantiti2[$ttkakhir] - $simpantiti2[$ttkawal]) * 2)) * 100), 0);
    $simpanakhirkomp[$i] = viewpersenkomp($simpanpersenkomp[$i]);
    $total = $total + $simpanakhirkomp[$i];
    $ttkawal++;
    $ttkakhir++;
    $i++;
}
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Detail Penilaian</h4></div>
    <div class="col-auto"><a  href="penilaian_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<div class="form-group">
    <label>ID Penilaian</label>
    <input type="text"  class="form-control" value="<?php echo($detail_id); ?>" disabled/>
</div>
<div class="form-group">
    <label>Penguji</label>
    <input type="text"  class="form-control" value="<?php while ($data = mysqli_fetch_assoc($stmt2)) {
    if ($detail_penguji == $data['penguji_id']) {
        echo "[" . $data['penguji_nuptk'] . "] " . $data['penguji_nama'];
    }
} ?>" disabled/>
</div>
<div class="form-group">
    <label>Peserta</label>
    <input type="text"  class="form-control" value="<?php while ($data = mysqli_fetch_assoc($stmt)) {
    if ($detail_peserta == $data['peserta_id']) {
        echo "[" . $data['peserta_nuptk'] . "] " . $data['peserta_nama'];
    }
} ?>" disabled/>
</div>
<div class="form-group">
    <label>Periode Penilaian</label>
    <input type="text"  class="form-control" value="<?php while ($data = mysqli_fetch_assoc($stmt3)) {
    if ($detail_periode == $data['periode_id']) {
        echo $data['periode_tglawal'] . ' sampai dengan ' . $data['periode_tglakhir'];
    }
} ?>" disabled/>
</div>
<div class="row">
    <div class="col-md-12">
        <label>Penilaian (Berdasarkan Kompetensi)</label>
        <!-- Custom Tabs -->
        <div class="nav-tabs">
            <ul class="nav nav-tabs">
                <li><a href="#tab_1" class="nav-item nav-link active" data-toggle="tab">1</a></li>
                <li><a href="#tab_2" class="nav-item nav-link" data-toggle="tab">2</a></li>
                <li><a href="#tab_3" class="nav-item nav-link" data-toggle="tab">3</a></li>
                <li><a href="#tab_4" class="nav-item nav-link" data-toggle="tab">4</a></li>
                <li><a href="#tab_5" class="nav-item nav-link" data-toggle="tab">5</a></li>
                <li><a href="#tab_6" class="nav-item nav-link" data-toggle="tab">6</a></li>
                <li><a href="#tab_7" class="nav-item nav-link" data-toggle="tab">7</a></li>
                <li><a href="#tab_8" class="nav-item nav-link" data-toggle="tab">8</a></li>
                <li><a href="#tab_9" class="nav-item nav-link" data-toggle="tab">9</a></li>
                <li><a href="#tab_10" class="nav-item nav-link" data-toggle="tab">10</a></li>
                <li><a href="#tab_11" class="nav-item nav-link" data-toggle="tab">11</a></li>
                <li><a href="#tab_12" class="nav-item nav-link" data-toggle="tab">12</a></li>
                <li><a href="#tab_13" class="nav-item nav-link" data-toggle="tab">13</a></li>
                <li><a href="#tab_14" class="nav-item nav-link" data-toggle="tab">14</a></li>
                <li><a href="#tab_15" class="nav-item nav-link" data-toggle="tab">Rangkuman</a></li>
            </ul>
            <div class="tab-content">
            <?php
            $i = 1;
            $ii = 0;
            $tabactive = "active";
            foreach ($kompkomp as $xx => $xxx) {
                ?>
                    <div class="tab-pane <?php echo $tabactive ?>" id="tab_<?php echo $i; ?>">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan='3'><b><?php echo $kompetensititle[$xx]; ?></b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($x = 0; $x < count($xxx); $x++) {
                                        ?>
                                        <tr>
                                            <td><?php echo ($x + 1); ?></td>
                                            <td><?php echo $xxx[$x]; ?></td>
                                            <td width="180px"> 
                                            <?php if ($simpannilaipoinkomp[$ii] == 0) {
                                                echo '<b>0</b> (Tidak Terpenuhi)';
                                            } ?>
                                            <?php if ($simpannilaipoinkomp[$ii] == 1) {
                                                echo '<b>1</b> (Terpenuhi Sebagian)';
                                            } ?>
                                            <?php if ($simpannilaipoinkomp[$ii] == 2) {
                                                echo '<b>2</b> (Seluruhnya Terpenuhi)';
                                            } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $ii++;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan='2'>Total skor</td>
                                        <td align='center'><b><?php echo $simpanjumlahskor[$xx]; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'>Skor maksimum = jumlah indikator x 2</td>
                                        <td align='center'><b><?php echo (($simpantiti2[($xx + 1)] - $simpantiti2[($xx)]) * 2); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'>Persentase = (total skor/Skor maksimum) x 100%</td>
                                        <td align='center'><b><?php echo $simpanpersenkomp[$xx] . " %"; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan='2'>Nilai kompetensi</td>
                                        <td align='center'><b><?php echo $simpanakhirkomp[$xx]; ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                <?php
                $tabactive = "";
                ++$i;
            }
            ?>
                <div class="tab-pane <?php echo $tabactive ?>" id="tab_15">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><b>Kompetensi</b></th>
                                    <th><b>Nilai</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan='2'><b>A. Pedagogik</b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[0]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[0]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[1]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[1]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[2]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[2]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[3]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[3]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[4]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[4]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[5]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[5]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[6]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[6]; ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><b>B. Kepribadian</b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[7]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[7]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[8]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[8]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[9]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[9]; ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><b>C. Sosial</b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[10]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[10]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[11]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[11]; ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan='2'><b>D. Profesional</b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[12]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[12]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kompetensititle[13]; ?></td>
                                    <td align='center'><b><?php echo $simpanakhirkomp[13]; ?></b></td>
                                </tr>
                                <tr>
                                    <td><b>Jumlah ( Hasil Penilaian Kinerja Guru )</b></td>
                                    <td align='center'><b><?php echo $total; ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<?php
include ("footer.php");
?> 