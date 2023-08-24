<?php
include 'config.php';
require 'crud.php';
$id = $_GET['kode'];
$data = mysqli_query($db, "SELECT * FROM nilai_peserta_detail 
        JOIN periode ON nilai_peserta_detail.detail_periode = periode.periode_id 
        JOIN peserta ON nilai_peserta_detail.detail_peserta = peserta.peserta_id
        JOIN penguji ON nilai_peserta_detail.detail_penguji = penguji.penguji_id
        WHERE detail_periode='$id'");
while ($a = mysqli_fetch_array($data)) {
    $k1 = viewpersenkomp(round((($a['K0101'] + $a['K0102'] + $a['K0103'] + $a['K0104'] + $a['K0105'] + $a['K0106']) / 12) * 100));
    $k2 = viewpersenkomp(round((($a['K0201'] + $a['K0202'] + $a['K0203'] + $a['K0204'] + $a['K0205'] + $a['K0206']) / 12) * 100));
    $k3 = viewpersenkomp(round((($a['K0301'] + $a['K0302'] + $a['K0303'] + $a['K0304']) / 8) * 100));
    $k4 = viewpersenkomp(round((($a['K0401'] + $a['K0402'] + $a['K0403'] + $a['K0404'] + $a['K0405'] + $a['K0406'] + $a['K0407'] + $a['K0408'] + $a['K0409'] + $a['K0410'] + $a['K0411']) / 22) * 100));
    $k5 = viewpersenkomp(round((($a['K0501'] + $a['K0502'] + $a['K0503'] + $a['K0504'] + $a['K0505'] + $a['K0506'] + $a['K0507']) / 14) * 100));
    $k6 = viewpersenkomp(round((($a['K0601'] + $a['K0602'] + $a['K0603'] + $a['K0604'] + $a['K0605'] + $a['K0606']) / 12) * 100));
    $k7 = viewpersenkomp(round((($a['K0701'] + $a['K0702'] + $a['K0703'] + $a['K0704'] + $a['K0705']) / 10) * 100));
    $k8 = viewpersenkomp(round((($a['K0801'] + $a['K0802'] + $a['K0803'] + $a['K0804'] + $a['K0805']) / 10) * 100));
    $k9 = viewpersenkomp(round((($a['K0901'] + $a['K0902'] + $a['K0903'] + $a['K0904'] + $a['K0905']) / 10) * 100));
    $k10 = viewpersenkomp(round((($a['K1001'] + $a['K1002'] + $a['K1003'] + $a['K1004'] + $a['K1005'] + $a['K1006'] + $a['K1007'] + $a['K1008']) / 16) * 100));
    $k11 = viewpersenkomp(round((($a['K1101'] + $a['K1102'] + $a['K1103']) / 6) * 100));
    $k12 = viewpersenkomp(round((($a['K1201'] + $a['K1202'] + $a['K1203']) / 6) * 100));
    $k13 = viewpersenkomp(round((($a['K1301'] + $a['K1302'] + $a['K1303']) / 6) * 100));
    $k14 = viewpersenkomp(round((($a['K1401'] + $a['K1402'] + $a['K1403'] + $a['K1404'] + $a['K1405'] + $a['K1406']) / 12) * 100));

    $ktot = $k1 + $k2 + $k3 + $k4 + $k5 + $k6 + $k7 + $k8 + $k9 + $k10 + $k11 + $k12 + $k13 + $k14
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Laporan Penilaian<br>SD Anak Saleh</h2>
                </div>
                <div class="col">
                    <h3 class="pull-right">Id # <?php echo $a['detail_id']; ?></h3>
                    <strong>Periode Penilaian:</strong><br>
                    <?php echo $a['periode_tglawal']; ?> s/d <?php echo $a['periode_tglakhir']; ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <strong>Nama GTK:</strong><br>
                    <?php echo $a['peserta_nuptk']; ?><br />
                    <?php echo $a['peserta_nama']; ?>
                </div>
                <div class="col">
                    <strong>Nama Penguji:</strong><br>
                    <?php echo $a['penguji_nuptk']; ?><br />
                    <?php echo $a['penguji_nama']; ?>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Rangkuman</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-sm" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><b>Kompetensi</b></th>
                                        <th><b>Nilai</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2"><b>A. Pedagogik</b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 1 : Mengenal Karakteristik Peserta Didik</td>
                                        <td align="center"><b><?php echo $k1; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 2 : Menguasai teori belajar dan prinsip-prinsip pembelajaran yang mendidik</td>
                                        <td align="center"><b><?php echo $k2; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 3 : Pengembangan Kurikulum</td>
                                        <td align="center"><b><?php echo $k3; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 4 : Menguasai teori belajar dan prinsip-prinsip pembelajaran yang mendidik</td>
                                        <td align="center"><b><?php echo $k4; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 5 : Memahami dan mengembangkan kompetensi</td>
                                        <td align="center"><b><?php echo $k5; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 6 : Komunikasi dengan peserta didik</td>
                                        <td align="center"><b><?php echo $k6; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 7 : Penilaian dan Evaluasi</td>
                                        <td align="center"><b><?php echo $k7; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>B. Kepribadian</b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 8 : Bertindak sesuai dengan norma agama, hukum, sosial dan kebudayaan nasional</td>
                                        <td align="center"><b><?php echo $k8; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 9 : Menunjukkan pribadi yang dewasa dan teladan</td>
                                        <td align="center"><b><?php echo $k9; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 10 : Etos kerja, tanggung jawab yang tinggi, rasa bangga menjadi guru</td>
                                        <td align="center"><b><?php echo $k10; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>C. Sosial</b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 11 : Bersikap inklusif, bertindak obyektif, serta tidak diskriminatif</td>
                                        <td align="center"><b><?php echo $k11; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 12 : Komunikasi dengan sesama guru, tenaga kependidikan, orang tua, peserta didik, dan masyarakat</td>
                                        <td align="center"><b><?php echo $k12; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>D. Profesional</b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 13 : Penguasaan materi, struktur, konsep dan pola pikir keilmuan yang mendukung mata pelajaran yang diampu</td>
                                        <td align="center"><b><?php echo $k13; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Kompetensi 14 : Mengembangkan keprofesionalan melalui tindakan yang reflektif</td>
                                        <td align="center"><b><?php echo $k14; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Jumlah ( Hasil Penilaian Kinerja Guru )</b></td>
                                        <td align="center"><b><?php echo $ktot; ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
                <div class="col">
                    <br>
                    <strong>Pengajar</strong><br><br><br><br>
                    <?php echo $a['peserta_nuptk']; ?><br />
                    <?php echo $a['peserta_nama']; ?>
                </div>
                <div class="col">
                    <strong>Malang, <?php echo date("d F Y")?></strong><br>
                    <strong>Penguji</strong><br><br><br><br>
                    <?php echo $a['penguji_nuptk']; ?><br />
                    <?php echo $a['penguji_nama']; ?>
                </div>
            </div>
            <br>
    </body>
    <script>
        window.print();
    </script>

    </html>

<?php } ?>