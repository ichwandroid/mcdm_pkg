<?php
include ("header.php");
require 'crud.php';
$success = 0;
$stmt = viewpeserta();
$stmt2 = viewpenguji();
$stmt3 = viewperiode();
$kompkomp = viewpoinkomp();
$kompetensititle = viewdafkomp();
$book = ambileditpengujipass($_SESSION['username']);
$edit = mysqli_fetch_assoc($book);
$detail_id = "";
$detail_peserta = "";
$detail_penguji = $edit['penguji_id'];
$detail_periode = ""; 
$total = 0;
$simpannilaipoinkomp = [0, 0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0, 0,
                        0, 0, 0, 0,
                        0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0,
                        0, 0, 0, 0, 0, 0, 0, 0,
                        0, 0, 0,
                        0, 0, 0,
                        0, 0, 0,
                        0, 0, 0, 0, 0, 0];
$simpanpersenkomp = array();
$simpanakhirkomp = array();
$simpantiti2 = [0, 6, 12, 16, 27, 34, 40, 45, 50, 55, 63, 66, 69, 72, 78];
if (isset($_POST['kirim'])) {
    $detail_id = $_POST['id'];
    $detail_peserta = $_POST['peserta'];
    $detail_penguji = $_POST['penguji'];
    $detail_periode = $_POST['periodepenilaian']; 
    $simpannilaipoinkomp = [$_POST['k11'], $_POST['k12'], $_POST['k13'], $_POST['k14'], $_POST['k15'], $_POST['k16'],
                            $_POST['k21'], $_POST['k22'], $_POST['k23'], $_POST['k24'], $_POST['k25'], $_POST['k26'],
                            $_POST['k31'], $_POST['k32'], $_POST['k33'], $_POST['k34'],
                            $_POST['k41'], $_POST['k42'], $_POST['k43'], $_POST['k44'], $_POST['k45'], $_POST['k46'], $_POST['k47'], $_POST['k48'], $_POST['k49'], $_POST['k410'], $_POST['k411'],
                            $_POST['k51'], $_POST['k52'], $_POST['k53'], $_POST['k54'], $_POST['k55'], $_POST['k56'], $_POST['k57'],
                            $_POST['k61'], $_POST['k62'], $_POST['k63'], $_POST['k64'], $_POST['k65'], $_POST['k66'],
                            $_POST['k71'], $_POST['k72'], $_POST['k73'], $_POST['k74'], $_POST['k75'],
                            $_POST['k81'], $_POST['k82'], $_POST['k83'], $_POST['k84'], $_POST['k85'],
                            $_POST['k91'], $_POST['k92'], $_POST['k93'], $_POST['k94'], $_POST['k95'],
                            $_POST['k101'], $_POST['k102'], $_POST['k103'], $_POST['k104'], $_POST['k105'], $_POST['k106'], $_POST['k107'], $_POST['k108'],
                            $_POST['k111'], $_POST['k112'], $_POST['k113'],
                            $_POST['k121'], $_POST['k122'], $_POST['k123'],
                            $_POST['k131'], $_POST['k132'], $_POST['k133'],
                            $_POST['k141'], $_POST['k142'], $_POST['k143'], $_POST['k144'], $_POST['k145'], $_POST['k146']];
    $ttkawal = 0;
    $ttkakhir= 1;
    $i = 0;
    for($ff=0; $ff < (count($simpantiti2)-1); $ff++){
        $temp  = 0;
        for($f=$simpantiti2[$ttkawal]; $f < $simpantiti2[$ttkakhir]; $f++){
            $temp=$temp+$simpannilaipoinkomp[$f];
        }
        $simpanpersenkomp[$i] = round((($temp/(($simpantiti2[$ttkakhir]-$simpantiti2[$ttkawal])*2))*100), 0);
        $simpanakhirkomp[$i] = viewpersenkomp($simpanpersenkomp[$i]);
        $total = $total + $simpanakhirkomp[$i];
        $ttkawal++;
        $ttkakhir++;
        $i++;
    }
    //echo "<br/>simpanpersenkomp = ";
    //print_r($simpanpersenkomp);
    //echo "<br/>simpanakhirkomp = ";
    //print_r($simpanakhirkomp);
    deletenilai($_POST['peserta']);
    addnilai($detail_peserta, 'C01', $simpanakhirkomp[0], $detail_periode);
    addnilai($detail_peserta, 'C02', $simpanakhirkomp[1], $detail_periode);
    addnilai($detail_peserta, 'C03', $simpanakhirkomp[2], $detail_periode);
    addnilai($detail_peserta, 'C04', $simpanakhirkomp[3], $detail_periode);
    addnilai($detail_peserta, 'C05', $simpanakhirkomp[4], $detail_periode);
    addnilai($detail_peserta, 'C06', $simpanakhirkomp[5], $detail_periode);
    addnilai($detail_peserta, 'C07', $simpanakhirkomp[6], $detail_periode);
    addnilai($detail_peserta, 'C08', $simpanakhirkomp[7], $detail_periode);
    addnilai($detail_peserta, 'C09', $simpanakhirkomp[8], $detail_periode);
    addnilai($detail_peserta, 'C10', $simpanakhirkomp[9], $detail_periode);
    addnilai($detail_peserta, 'C11', $simpanakhirkomp[10], $detail_periode);
    addnilai($detail_peserta, 'C12', $simpanakhirkomp[11], $detail_periode);
    addnilai($detail_peserta, 'C13', $simpanakhirkomp[12], $detail_periode);
    addnilai($detail_peserta, 'C14', $simpanakhirkomp[13], $detail_periode);
    $success = addnilaidetail($detail_id, $detail_peserta, $detail_penguji, $detail_periode, $simpannilaipoinkomp[0], 
    $simpannilaipoinkomp[1], 
    $simpannilaipoinkomp[2], 
    $simpannilaipoinkomp[3], 
    $simpannilaipoinkomp[4], 
    $simpannilaipoinkomp[5], 
    $simpannilaipoinkomp[6], 
    $simpannilaipoinkomp[7], 
    $simpannilaipoinkomp[8], 
    $simpannilaipoinkomp[9], 
    $simpannilaipoinkomp[10], 
    $simpannilaipoinkomp[11], 
    $simpannilaipoinkomp[12], 
    $simpannilaipoinkomp[13], 
    $simpannilaipoinkomp[14], 
    $simpannilaipoinkomp[15], 
    $simpannilaipoinkomp[16], 
    $simpannilaipoinkomp[17], 
    $simpannilaipoinkomp[18], 
    $simpannilaipoinkomp[19], 
    $simpannilaipoinkomp[20], 
    $simpannilaipoinkomp[21], 
    $simpannilaipoinkomp[22], 
    $simpannilaipoinkomp[23], 
    $simpannilaipoinkomp[24], 
    $simpannilaipoinkomp[25], 
    $simpannilaipoinkomp[26], 
    $simpannilaipoinkomp[27], 
    $simpannilaipoinkomp[28], 
    $simpannilaipoinkomp[29], 
    $simpannilaipoinkomp[30], 
    $simpannilaipoinkomp[31], 
    $simpannilaipoinkomp[32], 
    $simpannilaipoinkomp[33], 
    $simpannilaipoinkomp[34], 
    $simpannilaipoinkomp[35], 
    $simpannilaipoinkomp[36], 
    $simpannilaipoinkomp[37], 
    $simpannilaipoinkomp[38], 
    $simpannilaipoinkomp[39], 
    $simpannilaipoinkomp[40], 
    $simpannilaipoinkomp[41], 
    $simpannilaipoinkomp[42], 
    $simpannilaipoinkomp[43], 
    $simpannilaipoinkomp[44], 
    $simpannilaipoinkomp[45], 
    $simpannilaipoinkomp[46], 
    $simpannilaipoinkomp[47], 
    $simpannilaipoinkomp[48], 
    $simpannilaipoinkomp[49], 
    $simpannilaipoinkomp[50], 
    $simpannilaipoinkomp[51], 
    $simpannilaipoinkomp[52], 
    $simpannilaipoinkomp[53], 
    $simpannilaipoinkomp[54], 
    $simpannilaipoinkomp[55], 
    $simpannilaipoinkomp[56], 
    $simpannilaipoinkomp[57], 
    $simpannilaipoinkomp[58], 
    $simpannilaipoinkomp[59], 
    $simpannilaipoinkomp[60], 
    $simpannilaipoinkomp[61], 
    $simpannilaipoinkomp[62], 
    $simpannilaipoinkomp[63], 
    $simpannilaipoinkomp[64], 
    $simpannilaipoinkomp[65], 
    $simpannilaipoinkomp[66], 
    $simpannilaipoinkomp[67], 
    $simpannilaipoinkomp[68], 
    $simpannilaipoinkomp[69], 
    $simpannilaipoinkomp[70], 
    $simpannilaipoinkomp[71], 
    $simpannilaipoinkomp[72], 
    $simpannilaipoinkomp[73], 
    $simpannilaipoinkomp[74], 
    $simpannilaipoinkomp[75], 
    $simpannilaipoinkomp[76], 
    $simpannilaipoinkomp[77], $total );
    if ($success > 0) {
        $detail_id = "";
        $detail_peserta = "";
        $detail_penguji = "";
        $detail_periode = ""; 
        $total = 0;
        $simpannilaipoinkomp = [0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0,
                                0, 0, 0, 0, 0, 0, 0, 0,
                                0, 0, 0,
                                0, 0, 0,
                                0, 0, 0,
                                0, 0, 0, 0, 0, 0];
        echo' <div class="alert alert-success" role="alert">
                <strong>Sukses</strong>, data telah berhasil diinputkan.
            </div>';
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Silahkah Isi Untuk Melakukan Penilaian :</h4></div>
    <div class="col-auto"><a  href="penilaian_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<br/>
<form  method="post">
    <div class="form-group">
        <label>ID Penilaian</label>
        <input type="text"  class="form-control" placeholder="Silahkan isi dengan ID Penilaian" name="id" value="<?php echo($detail_id); ?>" required/>
    </div>
    <div class="form-group">
        <label>Penguji</label>
        <select class="form-control" name="penguji">
            <option>Pilih Penguji</option>
            <?php
                while ($data = mysqli_fetch_assoc($stmt2)) {
                ?>
                    <option value="<?php echo $data['penguji_id'] ?>" <?php if($detail_penguji == $data['penguji_id']){ echo 'selected'; } ?>>[<?php echo $data['penguji_nuptk'] ?>] <?php echo $data['penguji_nama'] ?></option>
                <?php
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Peserta</label>
        <select class="form-control" name="peserta">
            <option>Pilih Peserta</option>
            <?php
                while ($data = mysqli_fetch_assoc($stmt)) {
                ?>
                    <option value="<?php echo $data['peserta_id'] ?>" <?php if($detail_peserta == $data['peserta_id']){ echo 'selected'; } ?>>[<?php echo $data['peserta_nuptk'] ?>] <?php echo $data['peserta_nama'] ?></option>
                <?php
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Periode Penilaian</label>
        <select class="form-control" name="periodepenilaian">
            <option>Pilih Periode</option>
            <?php
                while ($data = mysqli_fetch_assoc($stmt3)) {
                ?>
                    <option value="<?php echo $data['periode_id'] ?>" <?php if($detail_periode == $data['periode_id']){ echo 'selected'; } ?>><?php echo $data['periode_tglawal'] ?> sampai dengan <?php echo $data['periode_tglakhir'] ?></option>
                <?php
                }
            ?>
        </select>
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
                </ul>
                <div class="tab-content">
                    <?php
                    $i = 1;
                    $ii = 0;
                    $tabactive = "active";
                    foreach ($kompkomp as $xx => $xxx) {
                    ?>
                    <div class="tab-pane <?php echo $tabactive?>" id="tab_<?php echo $i;?>">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan='3'><b><?php echo $kompetensititle[$xx];?></b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        for($x=0; $x < count($xxx); $x++){
                                    ?>
                                    <tr>
                                        <td><?php echo ($x+1);?></td>
                                        <td><?php echo $xxx[$x];?></td>
                                        <td width="180px"> 
                                            <select class="form-control" name="k<?php echo $i."".($x+1);?>">
                                                <option value="0" <?php if($simpannilaipoinkomp[$ii] == 0){ echo 'selected'; } ?>>0 = Tidak Terpenuhi</option>
                                                <option value="1" <?php if($simpannilaipoinkomp[$ii] == 1){ echo 'selected'; } ?>>1 = Terpenuhi Sebagian</option>
                                                <option value="2" <?php if($simpannilaipoinkomp[$ii] == 2){ echo 'selected'; } ?>>2 = Seluruhnya Terpenuhi</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php
                                        $ii++;
                                        }        
                                    ?>
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
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <br/>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Simpan
    </button>
    <button  type="reset" class="btn btn-warning">
        Reset
    </button>
</form>
<br/>
<?php
include ("footer.php");
?>