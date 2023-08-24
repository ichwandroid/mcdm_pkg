<?php 
    function hitung_ahp($bobot, $jml_kriteria, $jenis, $ind){
        ?>
        <div class="nav-tabs">
            <ul class="nav nav-tabs">
                <li><a href="#tabtab_1<?php echo $ind; ?>" class="nav-item nav-link active" data-toggle="tab">Tabel Perbandingan Bobot</a></li>
                <li><a href="#tabtab_2<?php echo $ind; ?>" class="nav-item nav-link" data-toggle="tab">Matriks Nilai Kriteria</a></li>
                <?php if($jenis == "kriteria"){?>
                <li><a href="#tabtab_3<?php echo $ind; ?>" class="nav-item nav-link" data-toggle="tab">Perhitungan Konsistensi</a></li>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabtab_1<?php echo $ind; ?>">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <?php
                                    foreach ($bobot as $k => $a1)
                                        echo "<th>$k</th>";
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $hitung1 = array();
                                foreach ($bobot as $k1 => $a1){
                                    echo '<tr><td><b>'.$k1.'</b></td>';
                                    foreach ($bobot as $k2 => $a2){
                                        $selisinilai = sqrt(pow($a1-$a2, 2));
                                        if($a1<$a2){
                                            $kata = "1/[".$k2."][".$k1."] =";
                                            $ptemp = 1/($selisinilai+1);
                                        }
                                        if($a1>$a2){
                                            $kata = "bobot asli =";
                                            $ptemp = $selisinilai+1;
                                        }
                                        if($k1==$k2){
                                            $kata = "";
                                            $ptemp = 1;
                                        }
                                        $hitung1[$k1][$k2] = $ptemp;
                                        echo '<td><div class="text-xs">'.$kata.'</div>'.round($ptemp, 4).'</td>';
                                    }
                                    echo '</tr><tr>';
                                }
                                $totalhitung1 = array();
                                $temp = 0;
                                $temp1 = "";
                                echo '<td><b>Jumlah</b></td>';
                                foreach ($bobot as $k1 => $a1){
                                    $temp = 0;
                                    foreach ($bobot as $k2 => $a2){
                                        $temp1 = $k1;
                                        $temp  = $temp + $hitung1[$k2][$k1];
                                    }
                                    echo '<td><b>'.round($temp, 4).'</b></td>';
                                    $totalhitung1[$temp1]=$temp;
                                }
                                echo '</tr>';

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="tabtab_2<?php echo $ind; ?>">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                    <th></th>
                                    <?php
                                    foreach ($bobot as $k => $a1)
                                        echo "<th>$k</th>";
                                    ?>
                                    <th>Rata-rata /<br/>Priority Vector</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ratahitung1 = array();
                                foreach ($bobot as $k1 => $a1){
                                    echo '<tr><td><b>'.$k1.'</b></td>';
                                    $temp = 0;
                                    foreach ($bobot as $k2 => $a2){
                                        if($totalhitung1[$k2] == 0){
                                            $temptemp = 0;
                                        }else{
                                            $temptemp = $hitung1[$k1][$k2]/$totalhitung1[$k2];
                                        }
                                        $temp = $temp + $temptemp;
                                        echo  '<td><div class="text-xs">bobot '.$k1.' / jumlah['.$k2.'] =</div>'.round($temptemp, 4).'</td>';
                                    }
                                    $temptemp = $temp/$jml_kriteria;
                                    $ratahitung1[$k1]=$temptemp;
                                    echo '<td><b>'.round($temptemp, 4).'</b></td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($jenis == "kriteria"){?>
                <div class="tab-pane" id="tabtab_3<?php echo $ind; ?>">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                        <th></th>
                                        <?php
                                        foreach ($bobot as $k => $a1)
                                            echo "<th>$k</th>";
                                        ?>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sumhitung1 = array();
                                    foreach ($bobot as $k1 => $a1){
                                        echo '<tr><td><b>'.$k1.'</b></td>';
                                        $temp = 0;
                                        foreach ($bobot as $k2 => $a2){
                                            $temptemp = $hitung1[$k1][$k2]*$ratahitung1[$k2];
                                            $temp = $temp + ($temptemp);
                                            echo  '<td><div class="text-xs">bobot '.$k2.' * rata-rata ['.$k1.'] =</div>'.round($temptemp, 4).'</td>';
                                        }
                                        $sumhitung1[$k1]=$temp;
                                        echo '<td><b>'.round($temp, 4).'</b></td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="20%" cellspacing="0">
                            <thead>
                                <?php
                                $temp = 0;
                                foreach ($bobot as $k1 => $a1){
                                    $temp = $temp + ($sumhitung1[$k1]/$ratahitung1[$k1]);
                                }
                                $t = 1/$jml_kriteria*$temp;

                                $ci = ($t-$jml_kriteria)/($jml_kriteria-1);
                                echo '<tr><td>Consistency Index (CI)</td><td>'.$ci.'</td></tr>';

                                $tampil2 = ambilir($jml_kriteria);
                                $htampil2 = mysqli_fetch_assoc($tampil2);
                                echo '<tr><td>IR</td><td>'.$htampil2['ahp_nilai'].'</td></tr>';
                                $cr = ($ci/$htampil2['ahp_nilai']);
                                echo '<tr><td>Consistency Ratio (CR)</td><td>'.$cr;
                                if($cr<=0.1){
                                    echo " [konsisten]</td></tr>";
                                }else{
                                    echo " [tidak konsisten]</td></tr>";
                                }
                                ?>
                            </thead>
                            </table>
                        </div>
                </div>
                <?php
                    }
                    ?>
            </div>
        </div>   
    <?php
        return $ratahitung1;
    }
?>