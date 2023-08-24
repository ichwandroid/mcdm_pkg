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
$simpannilaipoinkomp = array();
$simpanpersenkomp = array();
$simpanakhirkomp = array();
$simpantiti2 = [0, 6, 12, 16, 27, 34, 40, 45, 50, 55, 63, 66, 69, 72, 78];
?>
<div class="row">
    <div class="col-auto mr-auto"><h4>Silahkah Isi Untuk Membuat Penilaian Otomatis</h4></div>
    <div class="col-auto"><a  href="penilaian_view.php" class="btn btn-info">Lihat Data</i></a></div>
</div>
<br/>
<form  method="post">
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
    <br/>
    <button  type="submit" class="btn btn-primary" name="kirim">
        Buat Data
    </button>
</form>
<br/>
<?php
if (isset($_POST['kirim'])) {
    // deletenilaifull();
    // deleteinilaidetailfull();
    while ($data = mysqli_fetch_assoc($stmt)) {
        $detail_id = membuat_id("nilai_peserta_detail", "detail_id", "PE", "4");
        $detail_peserta =  $data['peserta_id'];
        $detail_penguji = $_POST['penguji'];
        $detail_periode = $_POST['periodepenilaian']; 
        for($ffx=0; $ffx < 78; $ffx++){
            $simpannilaipoinkomp[$ffx] = rand(0, 2);
        }
        $total = 0;
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
        // echo "-----------------------------------------------------------------------------------------------";
        // echo "id = ". $detail_id." peserta = ".$detail_peserta;
        // echo "<br/>simpanpersenkomp = ";
        // print_r($simpanpersenkomp);
        // echo "<br/>simpanakhirkomp = ";
        // print_r($simpanakhirkomp);
        
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
    }
    if ($success > 0) {
        echo' <div class="alert alert-success" role="alert">
                <strong>Sukses</strong>, data telah berhasil diinputkan.
            </div>';
    } else {
        echo' <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, data gagal diinputkan, silahkan coba inputkan kembali.
            </div>';
    }
}
include ("footer.php");
?>