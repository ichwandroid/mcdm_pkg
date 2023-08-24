<?php
    //-----------------------------------------------------Instansi------------------------------------------------------------------
    // Fungsi dibawah untuk menambah data
     function addinstansi($aid, $anama, $aalamat, $anotlp, $apimpinan, $apimpinannuptk) {
        include('config.php');
        $query = "INSERT INTO instansi (instansi_id, instansi_nama, instansi_alamat, instansi_notelp, instansi_pimpinan, instansi_pimpinannuptk) "
                    . "VALUES('$aid', '$anama', '$aalamat', '$anotlp', '$apimpinan', '$apimpinannuptk')";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    //Fungsi dibawah untuk mengambil data yang akan diubah berdasarkan id
    function ambileditinstansi($aid) {
        include('config.php');
        $query = "SELECT * FROM instansi WHERE instansi_id='$aid'";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //Fungsi dbawah untuk mengganti(update) data
    function updateinstansi($aid, $anama, $aalamat, $anotlp, $apimpinan, $apimpinannuptk) {
        include('config.php');
        $query = "UPDATE instansi "
                    . "SET instansi_nama='$anama', instansi_alamat='$aalamat', instansi_notelp='$anotlp', instansi_pimpinan='$apimpinan', instansi_pimpinannuptk='$apimpinannuptk' "
                    . "WHERE instansi_id='$aid'";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function viewinstansi() {
        include('config.php');
        $query = "select * from instansi "
                . "ORDER BY instansi_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //fungsi dibawah untuk menghapus data berdasarkan id
    function deleteinstansi($kode) {
        include('config.php');
        $sql = "DELETE FROM instansi WHERE instansi_id='$kode'";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    //-----------------------------------------------------Penguji------------------------------------------------------------------
    // Fungsi dibawah untuk menambah data
    function addpenguji($aid, $anama, $anuptk, $auser, $apass) {
        include('config.php');
        $query = "INSERT INTO penguji (`penguji_id`, `penguji_nama`, `penguji_nuptk`, `username`, `password`) "
                ."VALUES('$aid', '$anama', '$anuptk', '$auser', MD5('$apass'))";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    //Fungsi dibawah untuk mengambil data yang akan diubah berdasarkan id
    function ambileditpenguji($aid) {
        include('config.php');
        $query = "SELECT * FROM penguji WHERE penguji_id='$aid'";
        $result = mysqli_query($db,$query);
        return $result;
    }
     //Fungsi dibawah untuk mengambil data berdasarkan username 
     function ambileditpengujipass($aid) {
        include('config.php');
        $query = "SELECT * FROM penguji WHERE username='$aid'";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //Fungsi dbawah untuk mengganti(update) data
    function updatepenguji($aid, $anama, $anuptk) {
        include('config.php');
        $query = "UPDATE penguji "
                    . "SET penguji_nama='$anama', penguji_nuptk='$anuptk' "
                    . "WHERE penguji_id='$aid'";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
     //Fungsi dbawah untuk mengganti(update) data user sandi
     function updatepengujiuser($aid, $auser, $apass) {
        include('config.php');
        $query = "UPDATE penguji "
                    . "SET username='$auser', password=MD5('$apass') "
                    . "WHERE penguji_id='$aid'";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function viewpenguji() {
        include('config.php');
        $query = "select * from penguji "
                . "ORDER BY penguji_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //fungsi dibawah untuk menghapus data berdasarkan id
    function deletepenguji($kode) {
        include('config.php');
        $sql = "DELETE FROM penguji WHERE penguji_id='$kode'";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    //-----------------------------------------------------Peserta------------------------------------------------------------------
    // Fungsi dibawah untuk menambah data peserta
    function addpeserta($aid, $anama, $anuptk, $ajk, $ainstansi, $amatpel, $amasakerja) {
        include('config.php');
        $query = "INSERT INTO peserta (peserta_id, peserta_nama, peserta_nuptk, peserta_jk, peserta_instansi, peserta_matpel, peserta_masa_kerja) "
                    . "VALUES('$aid', '$anama', '$anuptk', '$ajk', '$ainstansi', '$amatpel', '$amasakerja')";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    //Fungsi dibawah untuk mengambil data yang akan diubah berdasarkan npm
    function ambileditpeserta($aid) {
        include('config.php');
        $query = "SELECT * FROM peserta WHERE peserta_id='$aid'";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //Fungsi dbawah untuk mengganti(update) data
    function updatepeserta($aid, $anama, $anuptk, $ajk, $ainstansi, $amatpel, $amasakerja) {
        include('config.php');
        $query = "UPDATE peserta "
                    . "SET peserta_nama='$anama', peserta_nuptk='$anuptk', peserta_jk='$ajk', peserta_instansi='$ainstansi', peserta_matpel='$amatpel', peserta_masa_kerja='$amasakerja' "
                    . "WHERE peserta_id='$aid'";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function viewpeserta() {
        include('config.php');
        $query = "SELECT a.peserta_id, a.peserta_nama, a.peserta_nuptk, a.peserta_jk, b.instansi_nama, a.peserta_matpel, a.peserta_masa_kerja FROM peserta a Left JOIN instansi b ON a.peserta_instansi=b.instansi_id ORDER BY peserta_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //fungsi dibawah untuk menghapus data berdasarkan id
    function deletepeserta($kode) {
        include('config.php');
        $sql = "DELETE FROM peserta WHERE peserta_id='$kode'";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    //-----------------------------------------------------bobot------------------------------------------------------------------
    // function addbobot($aid, $anama, $anilai) {
    //     include('config.php');
    //     $query = "INSERT INTO bobot (id_bobot, nama_bobot, nilai_bobot) "
    //                 . "VALUES('$aid', '$anama', '$anilai')";
    //     mysqli_query($db,$query);   
    //     return mysqli_affected_rows($db);
    // }
    function ambileditbobot($aid) {
        include('config.php');
        $query = "SELECT * FROM bobot WHERE bobot_id='$aid'";
        $result = mysqli_query($db,$query);
        return $result;
    }
    function updatebobot($aid, $anilai, $anilai2) {
        include('config.php');
        $query = "UPDATE bobot "
                    . "SET bobot_nilai='$anilai', bobot_ahp='$anilai2' "
                    . "WHERE bobot_id='$aid'";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function viewbobot() {
        include('config.php');
        $query = "select * from bobot "
                . "ORDER BY bobot_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    // function deletebobot($kode) {
    //     include('config.php');
    //     $sql = "DELETE FROM bobot WHERE id_bobot='$kode'";
    //     mysqli_query($db, $sql);
    //     return mysqli_affected_rows($db);
    // }
    //-----------------------------------------------------Periode------------------------------------------------------------------
    // Fungsi dibawah untuk menambah data
    function addperiode($aid, $aawal, $aakhir) {
        include('config.php');
        $query = "INSERT INTO periode (periode_id, periode_tglawal, periode_tglakhir) "
                    . "VALUES('$aid', '$aawal', '$aakhir')";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function viewperiode() {
        include('config.php');
        $query = "select * from periode "
                . "ORDER BY periode_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //fungsi dibawah untuk menghapus data berdasarkan id
    function deleteperiode($kode) {
        include('config.php');
        $sql = "DELETE FROM periode WHERE periode_id='$kode'";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    //-----------------------------------------------------nilaipeserta------------------------------------------------------------------
    function addnilai($aidpeserta, $aidbobot, $anilai, $aperiode) {
        include('config.php');
        $query = "INSERT INTO nilai_peserta (id_peserta, id_bobot, nilai, id_periode) "
                    . "VALUES('$aidpeserta', '$aidbobot', '$anilai', '$aperiode')";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function deletenilai($kode) {
        include('config.php');
        $sql = "DELETE FROM nilai_peserta WHERE id_peserta='$kode'";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    function deletenilaifull() {
        include('config.php');
        $sql = "DELETE FROM nilai_peserta";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    function viewpenilaian(){
        include('config.php');
        $query = "SELECT b.peserta_id, b.peserta_nama, c.bobot_id, a.nilai, c.bobot_nilai
                    FROM nilai_peserta a
                    LEFT JOIN peserta b ON a.id_peserta = b.peserta_id
                    LEFT JOIN bobot c ON a.id_bobot = c.bobot_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    function viewpenilaianahp(){
        include('config.php');
        $query = "SELECT b.peserta_id, b.peserta_nama, c.bobot_id, a.nilai, c.bobot_ahp
                    FROM nilai_peserta a
                    LEFT JOIN peserta b ON a.id_peserta = b.peserta_id
                    LEFT JOIN bobot c ON a.id_bobot = c.bobot_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //-----------------------------------------------------nilaiir------------------------------------------------------------------
    function ambilir($aid) {
        include('config.php');
        $query = "SELECT ahp_nilai FROM ahp_ir WHERE ahp_jumlah='$aid'";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //-----------------------------------------------------simpanhasil------------------------------------------------------------------
    function addsimpanhasil($aidpeserta, $ametode, $anilai) {
        include('config.php');
        $query = "INSERT INTO hasil (id_peserta, metode, nilai_hasil) "
                    . "VALUES('$aidpeserta', '$ametode', '$anilai')";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function deletesimpanhasil() {
        include('config.php');
        $sql = "DELETE FROM hasil";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    function viewsimpanhasil($kode) {
        include('config.php');
        $query = "select * from hasil WHERE metode='$kode'"
                . "ORDER BY nilai_hasil DESC";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //-----------------------------------------------------nilai peserta detail------------------------------------------------------------------
    // Fungsi dibawah untuk menambah data
    function addnilaidetail($detail_id, $detail_peserta, $detail_penguji, $detail_periode, $K0101, $K0102, $K0103, $K0104, $K0105, $K0106, $K0201, $K0202, $K0203, $K0204, $K0205, $K0206, $K0301, $K0302, $K0303, $K0304, $K0401, $K0402, $K0403, $K0404, $K0405, $K0406, $K0407, $K0408, $K0409, $K0410, $K0411, $K0501, $K0502, $K0503, $K0504, $K0505, $K0506, $K0507, $K0601, $K0602, $K0603, $K0604, $K0605, $K0606, $K0701, $K0702, $K0703, $K0704, $K0705, $K0801, $K0802, $K0803, $K0804, $K0805, $K0901, $K0902, $K0903, $K0904, $K0905, $K1001, $K1002, $K1003, $K1004, $K1005, $K1006, $K1007, $K1008, $K1101, $K1102, $K1103, $K1201, $K1202, $K1203, $K1301, $K1302, $K1303, $K1401, $K1402, $K1403, $K1404, $K1405, $K1406, $total) {
        include('config.php');
        $query = "INSERT INTO nilai_peserta_detail (detail_id, detail_peserta, detail_penguji, detail_periode, K0101, K0102, K0103, K0104, K0105, K0106, K0201, K0202, K0203, K0204, K0205, K0206, K0301, K0302, K0303, K0304, K0401, K0402, K0403, K0404, K0405, K0406, K0407, K0408, K0409, K0410, K0411, K0501, K0502, K0503, K0504, K0505, K0506, K0507, K0601, K0602, K0603, K0604, K0605, K0606, K0701, K0702, K0703, K0704, K0705, K0801, K0802, K0803, K0804, K0805, K0901, K0902, K0903, K0904, K0905, K1001, K1002, K1003, K1004, K1005, K1006, K1007, K1008, K1101, K1102, K1103, K1201, K1202, K1203, K1301, K1302, K1303, K1401, K1402, K1403, K1404, K1405, K1406, total) "
                    . "VALUES('$detail_id', '$detail_peserta', '$detail_penguji', '$detail_periode', '$K0101', '$K0102', '$K0103', '$K0104', '$K0105', '$K0106', '$K0201', '$K0202', '$K0203', '$K0204', '$K0205', '$K0206', '$K0301', '$K0302', '$K0303', '$K0304', '$K0401', '$K0402', '$K0403', '$K0404', '$K0405', '$K0406', '$K0407', '$K0408', '$K0409', '$K0410', '$K0411', '$K0501', '$K0502', '$K0503', '$K0504', '$K0505', '$K0506', '$K0507', '$K0601', '$K0602', '$K0603', '$K0604', '$K0605', '$K0606', '$K0701', '$K0702', '$K0703', '$K0704', '$K0705', '$K0801', '$K0802', '$K0803', '$K0804', '$K0805', '$K0901', '$K0902', '$K0903', '$K0904', '$K0905', '$K1001', '$K1002', '$K1003', '$K1004', '$K1005', '$K1006', '$K1007', '$K1008', '$K1101', '$K1102', '$K1103', '$K1201', '$K1202', '$K1203', '$K1301', '$K1302', '$K1303', '$K1401', '$K1402', '$K1403', '$K1404', '$K1405', '$K1406', '$total')";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    //Fungsi dibawah untuk mengambil data yang akan diubah berdasarkan id
    function ambileditnilaidetail($aid) {
        include('config.php');
        $query = "SELECT * FROM nilai_peserta_detail WHERE detail_id='$aid'";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //Fungsi dbawah untuk mengganti(update) data
    function updatenilaidetail($detail_id, $detail_peserta, $detail_penguji, $detail_periode, $K0101, $K0102, $K0103, $K0104, $K0105, $K0106, $K0201, $K0202, $K0203, $K0204, $K0205, $K0206, $K0301, $K0302, $K0303, $K0304, $K0401, $K0402, $K0403, $K0404, $K0405, $K0406, $K0407, $K0408, $K0409, $K0410, $K0411, $K0501, $K0502, $K0503, $K0504, $K0505, $K0506, $K0507, $K0601, $K0602, $K0603, $K0604, $K0605, $K0606, $K0701, $K0702, $K0703, $K0704, $K0705, $K0801, $K0802, $K0803, $K0804, $K0805, $K0901, $K0902, $K0903, $K0904, $K0905, $K1001, $K1002, $K1003, $K1004, $K1005, $K1006, $K1007, $K1008, $K1101, $K1102, $K1103, $K1201, $K1202, $K1203, $K1301, $K1302, $K1303, $K1401, $K1402, $K1403, $K1404, $K1405, $K1406, $total) {
        include('config.php');
        $query = "UPDATE nilai_peserta_detail "
                    . "SET detail_peserta='$detail_peserta', detail_penguji='$detail_penguji', detail_periode='$detail_periode', K0101='$K0101', K0102='$K0102', K0103='$K0103', K0104='$K0104', K0105='$K0105', K0106='$K0106', K0201='$K0201', K0202='$K0202', K0203='$K0203', K0204='$K0204', K0205='$K0205', K0206='$K0206', K0301='$K0301', K0302='$K0302', K0303='$K0303', K0304='$K0304', K0401='$K0401', K0402='$K0402', K0403='$K0403', K0404='$K0404', K0405='$K0405', K0406='$K0406', K0407='$K0407', K0408='$K0408', K0409='$K0409', K0410='$K0410', K0411='$K0411', K0501='$K0501', K0502='$K0502', K0503='$K0503', K0504='$K0504', K0505='$K0505', K0506='$K0506', K0507='$K0507', K0601='$K0601', K0602='$K0602', K0603='$K0603', K0604='$K0604', K0605='$K0605', K0606='$K0606', K0701='$K0701', K0702='$K0702', K0703='$K0703', K0704='$K0704', K0705='$K0705', K0801='$K0801', K0802='$K0802', K0803='$K0803', K0804='$K0804', K0805='$K0805', K0901='$K0901', K0902='$K0902', K0903='$K0903', K0904='$K0904', K0905='$K0905', K1001='$K1001', K1002='$K1002', K1003='$K1003', K1004='$K1004', K1005='$K1005', K1006='$K1006', K1007='$K1007', K1008='$K1008', K1101='$K1101', K1102='$K1102', K1103='$K1103', K1201='$K1201', K1202='$K1202', K1203='$K1203', K1301='$K1301', K1302='$K1302', K1303='$K1303', K1401='$K1401', K1402='$K1402', K1403='$K1403', K1404='$K1404', K1405='$K1405', K1406='$K1406', total='$total' "
                    . "WHERE detail_id='$detail_id'";
        mysqli_query($db,$query);   
        return mysqli_affected_rows($db);
    }
    function viewnilaidetail() {
        include('config.php');
        $query = "SELECT a.*, b.peserta_nama, b.peserta_nuptk, c.penguji_nama, c.penguji_nuptk, d.instansi_nama, e.periode_tglawal, e.periode_tglakhir "
                ."FROM nilai_peserta_detail a " 
                ."LEFT JOIN peserta b ON a.detail_peserta = b.peserta_id "
                ."LEFT JOIN penguji c ON a.detail_penguji= c.penguji_id "
                ."LEFT JOIN instansi d ON b.peserta_instansi = d.instansi_id "
                ."LEFT JOIN periode e ON a.detail_periode = e.periode_id "
                ."ORDER BY detail_id";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //fungsi view untuk perangkingan
    function viewnilaidetailperangkingan() {
        include('config.php');
        $query = "SELECT detail_peserta, total "
                ."FROM nilai_peserta_detail " 
                ."ORDER BY total DESC";
        $result = mysqli_query($db,$query);
        return $result;
    }
	//fungsi view untuk perangkingan
    function viewnilaidetailperangkinganb() {
        include('config.php');
        $query = "SELECT * "
                ."FROM nilai_peserta_detail a " 
				."LEFT JOIN peserta b ON a.detail_peserta = b.peserta_id "
                ."ORDER BY total DESC";
        $result = mysqli_query($db,$query);
        return $result;
    }
    //fungsi dibawah untuk menghapus data berdasarkan id
    function deleteinilaidetail($kode) {
        include('config.php');
        $sql = "DELETE FROM nilai_peserta_detail WHERE detail_id='$kode'";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    //fungsi dibawah untuk menghapus semua data
    function deleteinilaidetailfull() {
        include('config.php');
        $sql = "DELETE FROM nilai_peserta_detail";
        mysqli_query($db, $sql);
        return mysqli_affected_rows($db);
    }
    //-----------------------------------------------------untuk form--------------------------------------------------------------------------
    //fungsi dibawah untuk menyimpan poin penilaian setiap kompetensi
    function viewpoinkomp() {
        $kompetensi01 = ["Guru dapat mengidentifikasi karakteristik belajar setiap peserta didik di kelasnya" ,
                        "Guru memastikan bahwa semua peserta didik mendapatkan kesempatan yang sama untuk berpartisipasi aktif dalam kegiatan pembelajaran" ,
                        "Guru dapat mengatur kelas untuk memberikan kesempatan belajar yang sama pada semua peserta didik dengan kelainan fisik dan kemampuan belajar yang berbeda" ,
                        "Guru mencoba mengetahui penyebab penyimpangan perilaku peserta didik untuk mencegah agar perilaku tersebut tidak merugikan peserta didik lainnya" ,
                        "Guru membantu mengembangkan potensi dan mengatasi kekurangan peserta didik" , 
                        "Guru memperhatikan peserta didik dengan kelemahan fisik tertentu agar dapat mengikuti aktivitas pembelajaran, sehingga peserta didik tersebut tidak termarginalkan (tersisihkan, diolok-olok, minder, dsb.)"];
        $kompetensi02 = ["Guru memberi kesempatan kepada peserta didik untuk menguasai materi pembelajaran sesuai usia dan kemampuan belajarnya melalui pengaturan proses pembelajaran dan aktivitas yang bervariasi",
                        "Guru selalu memastikan tingkat pemahaman peserta didik terhadap materi pembelajaran tertentu dan menyesuaikan aktivitas pembelajaran berikutnya berdasarkan tingkat pemahaman tersebut",
                        "Guru dapat menjelaskan alasan pelaksanaan kegiatan/aktivitas yang dilakukannya,baik yang sesuai maupun yang berbeda dengan rencana,terkait keberhasilan pembelajaran",
                        "Guru menggunakan berbagai teknik untuk memotiviasi kemauan belajar peserta didik",
                        "Guru merencanakan kegiatan pembelajaran yang saling terkait satu sama lain, dengan memperhatikan tujuan pembelajaran maupun proses belajar peserta didik",
                        "Guru memperhatikan respon peserta didik yang belum/kurang memahami materi pembelajaran yang diajarkan dan menggunakannya untuk memperbaiki rancangan pembelajaran berikutnya"];
        $kompetensi03 = ["Guru dapat menyusun silabus yang sesuai dengan kurikulum",
                        "Guru merancang rencana pembelajaran yang sesuai dengan silabus untuk membahas materi ajar tertentu agar peserta didik dapat mencapai kompetensi dasar yang ditetapkan",
                        "Guru mengikuti urutan materi pembelajaran dengan memperhatikan tujuan pembelajaran",
                        "Guru memilih materi pembelajaran yang: a) sesuai dengan tujuan pembelajaran, b) tepat dan mutakhir, c) sesuai dengan usia dan tingkat kemampuan belajar peserta didik, dan d) dapat dilaksanakan di kelas e) sesuai dengan konteks kehidupan sehari-hari peserta didik"];
        $kompetensi04 = ["Guru melaksanakan aktivitas pembelajaran sesuai dengan rancangan yang telah disusun secara lengkap dan pelaksanaan aktivitas tersebut mengindikasikan bahwa guru mengerti tentang tujuannya",
                        "Guru melaksanakan aktivitas pembelajaran yang bertujuan untuk membantu proses belajar peserta didik, bukan untuk menguji sehingga membuat peserta didik merasa tertekan",
                        "Guru mengkomunikasikan informasi baru (misalnya materi tambahan) sesuai dengan usia dan tingkat kemampuan belajar peserta didik",
                        "Guru menyikapi kesalahan yang dilakukan peserta didik sebagai tahapan proses pembelajaran,bukan semata-mata kesalahan yang harus dikoreksi. Misalnya:dengan mengetahu iterlebih dahulu peserta didik lain yang setuju atau tidak setuju dengan jawaban tersebut, sebelum memberikan penjelasan tentang jawaban yang benar",
                        "Guru melaksanakan kegiatan pembelajaran sesuai  isi kurikulum dan mengkaitkannya dengan konteks kehidupan sehari-hari peserta didik",
                        "Guru melakukan aktivitas pembelajaran secara bervariasi dengan waktu yang cukup untuk kegiatan pembelajaran yang sesuai dengan usia dan tingkat kemampuan belajar dan mempertahankan perhatian peserta didik",
                        "Guru mengelola kelas dengan efektif tanpa mendominasi atau sibuk dengan kegiatannya sendiri agar semua waktu peserta dapat termanfaatkan secara produktif",
                        "Guru mampu menyesuaikan aktivitas pembelajaran yang dirancang dengan kondisi kelas",
                        "Guru memberikan banyak kesempatan kepada peserta didik untuk bertanya, mempraktekkan dan berinteraksi dengan peserta didik lain",
                        "Guru mengatur pelaksanaan aktivitas pembelajaran secara sistematis untuk membantu proses belajar peserta didik. Sebagai contoh: guru menambah informasi baru setelah mengevaluasi pemahaman peserta didik terhadap materi sebelumnya",
                        "Guru menggunakan alat bantu mengajar, dan/atau audio-visual (termasuk TIK) untuk meningkatkan motivasi belajar peserta didik dalam mencapai tujuan pembelajaran"];
        $kompetensi05 = ["Guru menganalisis hasil belajar berdasarkan segala bentuk penilaian terhadap setiap peserta didik untuk mengetahui tingkat kemajuan masing-masing",
                        "Guru merancang dan melaksanakan aktivitas pembelajaran yang mendorong peserta didik untuk belajar sesuai dengan kecakapan dan pola belajar masing-masing",
                        "Guru merancang dan melaksanakan aktivitas pembelajaran untuk memunculkan daya kreativitas dan kemampuan berfikir kritis peserta didik",
                        "Guru secara aktif membantu peserta didik dalam proses pembelajaran dengan memberikan perhatian kepada setiap individu",
                        "Guru dapat mengidentifikasi dengan benar tentang bakat, minat, potensi, dan kesulitan belajar masing-masing peserta didik",
                        "Guru memberikan kesempatan belajar kepada peserta didik sesuai dengan cara belajarnya masing-masing",
                        "Guru memusatkan perhatian pada interaksi dengan peserta didik dan mendorongnya untuk memahami dan menggunakan informasi yang disampaikan"];
        $kompetensi06 = ["Guru menggunakan pertanyaan untuk mengetahui pemahaman dan menjaga partisipasi peserta didik, termasuk memberikan pertanyaan terbuka yang menuntut peserta didik untuk menjawab dengan ide dan pengetahuan mereka",
                        "Guru memberikan perhatian dan mendengarkan semua pertanyaan dan tanggapan peserta didik, tanpa menginterupsi, kecuali jika diperlukan untuk membantu atau mengklarifikasi pertanyaan/tanggapan tersebut",
                        "Guru menanggapinya pertanyaan peserta didik secara tepat, benar, dan mutakhir, sesuai tujuan pembelajaran dan isi kurikulum, tanpa mempermalukannya",
                        "Guru menyajikan kegiatan pembelajaran yang dapat menumbuhkan kerja sama yang baik antar peserta didik",
                        "Guru mendengarkan dan memberikan perhatian terhadap semua jawaban peserta didik baik yang benar maupun yang dianggap salah untuk mengukur tingkat pemahaman peserta didik",
                        "Guru memberikan perhatian terhadap pertanyaan peserta didik dan meresponnya secara lengkap dan relevan untuk menghilangkan kebingungan pada peserta didik"];
        $kompetensi07 = ["Guru menyusun alat penilaian yang sesuai dengan tujuan pembelajaran untuk mencapai kompetensi tertentu seperti yang tertulis dalam RPP",
                        "Guru melaksanakan penilaian dengan berbagai teknik dan jenis penilaian, selain penilaian formal yang dilaksanakan sekolah, dan mengumumkan hasil serta implikasinya kepada peserta didik, tentang tingkat pemahaman terhadap materi pembelajaran yang telah dan akan dipelajari",
                        "Guru menganalisis hasil penilaian untuk mengidentifikasi topik/kompetensi dasar yang sulit sehingga diketahui kekuatan dan kelemahan masing-masing peserta didik untuk keperluan remedial dan pengayaan",
                        "Guru memanfaatkan masukan dari peserta didik dan merefleksikannya untuk meningkatkan pembelajaran selanjutnya, dan dapat membuktikannya melalui catatan, jurnal pembelajaran, rancangan pembelajaran, materi tambahan, dan sebagainya",
                        "Guru memanfatkan hasil penilaian sebagai bahan penyusunan rancangan pembelajaran yang akan dilakukan selanjutnya"];
        $kompetensi08 = ["Guru menghargai dan mempromosikan prinsip-prinsip Pancasila sebagai dasar ideologi dan etika bagi semua warga Indonesia",
                        "Guru mengembangkan kerjasama dan membina kebersamaan dengan teman sejawat tanpa memperhatikan perbedaan yang ada (misalnya: suku, agama, dan gender)",
                        "Guru saling menghormati dan menghargai teman sejawat sesuai dengan kondisi dan keberadaan masing-masing",
                        "Guru memiliki rasa persatuan dan kesatuan sebagai bangsa Indonesia",
                        "Guru mempunyai pandangan yang luas tentang keberagaman bangsa Indonesia (misalnya: budaya, suku, agama)"];
        $kompetensi09 = ["Guru bertingkah laku sopan dalam berbicara, berpenampilan, dan berbuat terhadap semua peserta didik, orang tua, dan teman sejawat",
                        "Guru mau membagi pengalamannya dengan teman sejawat, termasuk mengundang mereka untuk mengobservasi cara mengajarnya dan memberikan masukan",
                        "Guru mampu mengelola pembelajaran yang membuktikan bahwa guru dihormati oleh peserta didik, sehingga semua peserta didik selalu memperhatikan guru dan berpartisipasi aktif dalam proses pembelajaran",
                        "Guru bersikap dewasa dalam menerima masukan dari peserta didik dan memberikan kesempatan kepada peserta didik untuk berpartisipasi dalam proses pembelajaran",
                        "Guru berperilaku baik untuk mencitrakan nama baik sekolah"];
        $kompetensi10 = ["Guru mengawali dan mengakhiri pembelajaran dengan tepat waktu",
                        "Jika guru harus meninggalkan kelas, guru mengaktifkan siswa dengan melakukan hal-hal produktif terkait dengan mata pelajaran, dan meminta guru piket atau guru lain untuk mengawasi kelas",
                        "Guru memenuhi jam mengajar dan dapat melakukan semua kegiatan lain di luar jam mengajar berdasarkan ijin dan persetujuan pengelola sekolah",
                        "Guru meminta ijin dan memberitahu lebih awal, dengan memberikan alasan dan bukti yang sah jika tidak menghadiri kegiatan yang telah direncanakan, termasuk proses pembelajaran di kelas",
                        "Guru menyelesaikan semua tugas administratif dan non-pembelajaran dengan tepat waktu sesuai standar yang ditetapkan",
                        "Guru memanfaatkan waktu luang selain mengajar untuk kegiatan yang produktif terkait dengan tugasnya",
                        "Guru memberikan kontribusi terhadap pengembangan sekolah dan mempunyai prestasi yang berdampak positif terhadap nama baik sekolah",
                        "Guru merasa bangga dengan profesinya sebagai guru"];
        $kompetensi11 = ["Guru memperlakukan semua peserta didik secara adil, memberikan perhatian dan bantuan sesuai kebutuhan masing-masing, tanpa memperdulikan faktor personal",
                        "Guru menjaga hubungan baik dan peduli dengan teman sejawat (bersifat inklusif), serta berkontribusi positif terhadap semua diskusi formal dan informal terkait dengan pekerjaannya",
                        "Guru sering berinteraksi dengan peserta didik dan tidak membatasi perhatiannya hanya pada kelompok tertentu (misalnya: peserta didik yang pandai, kaya, berasal dari daerah yang sama dengan guru)"];
        $kompetensi12 = ["Guru menyampaikan informasi tentang kemajuan, kesulitan, dan potensi peserta didik kepada orang tuanya, baik dalam pertemuan formal maupun tidak formal antara guru dan orang tua, teman sejawat, dan dapat menunjukkan buktinya",
                        "Guru ikut berperan aktif dalam kegiatan di luar pembelajaran yang diselenggarakan oleh sekolah dan masyarakat dan dapat memberikan bukti keikutsertaannya",
                        "Guru memperhatikan sekolah sebagai bagian dari masyarakat, berkomunikasi dengan masyarakat sekitar, serta berperan dalam kegiatan sosial di masyarakat"];
        $kompetensi13 = ["Guru melakukan pemetaan standar kompetensi dan kompetensi dasar untuk mata pelajaran yang diampunya, untuk mengidentifikasi materi pembelajaran yang dianggap sulit, melakukan perencanaan dan pelaksanaan pembelajaran, dan memperkirakan alokasi waktu yang diperlukan",
                        "Guru menyertakan informasi yang tepat dan mutakhir di dalam perencanaan dan pelaksanaan pembelajaran",
                        "Guru menyusun materi, perencanaan dan pelaksanaan pembelajaran yang berisi informasi yang tepat, mutakhir, dan yang membantu peserta didik untuk memahami konsep materi pembelajaran"];
        $kompetensi14 = ["Guru melakukan evaluasi diri secara spesifik, lengkap, dan didukung dengan contoh pengalaman diri sendiri",
                        "Guru memiliki jurnal pembelajaran, catatan masukan dari kolega atau hasil penilaian proses pembelajaran sebagai bukti yang menggambarkan kinerjanya",
                        "Guru memanfaatkan bukti gambaran kinerjanya untuk mengembangkan perencanaan dan pelaksanaan pembelajaran selanjutnya dalam program Pengembangan Keprofesian Berkelanjutan (PKB)",
                        "Guru dapat mengaplikasikan pengalaman PKB dalam perencanaan, pelaksanaan, penilaian pembelajaran dan tindak lanjutnya",
                        "Guru melakukan penelitian, mengembangkan karya inovasi, mengikuti kegiatan ilmiah (misalnya seminar, konferensi), dan aktif dalam melaksanakan PKB",
                        "Guru dapat memanfaatkan TIK dalam berkomunikasi dan pelaksanaan PKB"];
        $kompkomp = [$kompetensi01, $kompetensi02, $kompetensi03, $kompetensi04, $kompetensi05, $kompetensi06, $kompetensi07, $kompetensi08, $kompetensi09, $kompetensi10, $kompetensi11, $kompetensi12, $kompetensi13, $kompetensi14];
        return $kompkomp;
    }
    //fungsi dibawah untuk menyimpan daftar kompetensi
    function viewdafkomp() {
        $kompetensititle = ["Kompetensi 1 : Mengenal Karakteristik Peserta Didik",
                    "Kompetensi 2 : Menguasai teori belajar dan prinsip-prinsip pembelajaran yang mendidik",
                    "Kompetensi 3 : Pengembangan Kurikulum",
                    "Kompetensi 4 : Menguasai teori belajar dan prinsip-prinsip pembelajaran yang mendidik",
                    "Kompetensi 5 : Memahami dan mengembangkan kompetensi",
                    "Kompetensi 6 : Komunikasi dengan peserta didik",
                    "Kompetensi 7 : Penilaian dan Evaluasi",
                    "Kompetensi 8 : Bertindak sesuai dengan norma agama, hukum, sosial dan kebudayaan nasional",
                    "Kompetensi 9 : Menunjukkan pribadi yang dewasa dan teladan",
                    "Kompetensi 10 : Etos kerja, tanggung jawab yang tinggi, rasa bangga menjadi guru",
                    "Kompetensi 11 : Bersikap inklusif, bertindak obyektif, serta tidak diskriminatif",
                    "Kompetensi 12 : Komunikasi dengan sesama guru, tenaga kependidikan, orang tua, peserta didik, dan masyarakat",
                    "Kompetensi 13 : Penguasaan materi, struktur, konsep dan pola pikir keilmuan yang mendukung mata pelajaran yang diampu",
                    "Kompetensi 14 : Mengembangkan keprofesionalan melalui tindakan yang reflektif"];
        return $kompetensititle;
    }
    //fungsi dibawah untuk menghitung nilai kompetensi
    function viewpersenkomp($persen) {
        $hasil = 0;
        if($persen >= 0 && $persen <= 25){
            $hasil = 1;
        }else if($persen > 25 && $persen <= 50){
            $hasil = 2;
        }else if($persen > 50 && $persen <= 75){
            $hasil = 3;
        }else if($persen > 75 && $persen <= 100){
            $hasil = 4;
        }
        return $hasil;
    }
    //-----------------------------------------------------membuat primarykey otomatis--------------------------------------------------------------------------
    function membuat_id($tabel,$pk,$text,$jml){
        include('config.php');
        $query = mysqli_query($db,"SELECT RIGHT($pk,$jml) AS 'max' FROM $tabel ORDER BY $pk DESC LIMIT 1");
        $list = mysqli_fetch_array($query);
        $number = $list['max']+1;
        $new_id = $text.str_pad($number,$jml,"0",STR_PAD_LEFT);
        return $new_id;
    }
    //-----------------------------------------------------perbandingan-----------------------------------------------------------------------------------------
    function perbandingan($nilaimetode, $nilaimanual, $arraynilaimanual) {
        $tdksama = 0;
        $temptdksama = true;
        if($nilaimetode==$nilaimanual){
            $temptdksama = false;
            echo "<td><b>[".$nilaimetode."]</b></td>";
        }else{
            echo "<td>";
            foreach($arraynilaimanual as $x=>$x_value) {
                //echo $x." ".$x_value."</br>";
                if($arraynilaimanual[$nilaimanual] == $x_value){
                    if($arraynilaimanual[$nilaimetode] == $x_value){
                        echo "<div class='text-xs'>";
                        if($nilaimetode==$x){
                            $temptdksama = false;
                            echo "<b>[".$nilaimetode." ".$x." ".$x_value."] </b> | ";
                        }else{
                            echo $nilaimetode." ".$x." ".$x_value." | ";
                        }
                        echo "</div>";
                    }
                }
             }
            
            if($temptdksama == true){
                $tdksama++;
                echo $nilaimetode;
            }else{
                echo "<b>[".$nilaimetode."]</b>";
            }
            echo "</td>";
        }
        return $tdksama;
    }
