<?php
error_reporting(0);
/*
Plugin Name: Kalkulator Weton
Description: Kalkulator weton untuk situs tomyaditama.com
Author: Khoirul Aksara
Author URI: https://kalingga.my.id
Version: 1.0
*/
function weton_shortcode() { 
    // dipilih tanggal 1 Januari 1 sebagai acuan
    // hari pasaran tanggal 1 Januari 1900 adalah 'Senin Pahing'
    $tgl1 = "1900-01-01"; 
    
    // array urutan nama hari pasaran dimulai dari 'Pahing' 
    $pasaran = array('Pahing', 'Pon', 'Wage', 'Kliwon', 'Legi');
    $neppas = array(9,7,4,8,5);

    $dino = array(
        'Sunday' => 'Ahad',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jum\'at',
        'Saturday' => 'Sabtu'
    );
    $nepdino = array(
        'Sunday' => 5,
        'Monday' => 4,
        'Tuesday' => 3,
        'Wednesday' => 7,
        'Thursday' => 8,
        'Friday' => 6,
        'Saturday' => 9    
    );

    $string .= '
    <form style="text-align:center" action="" method="post" name="cariweton" autocomplete="off">
        <div class="form-field">    
            <label>Masukkan Tanggal Lahir Anda: </label>
            <input name="tanggal" required style="width:20%" maxlength="2">
            <select name="bulan" required style="width:30%">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <input name="tahun" required style="width:20%" maxlength="4">
            <button type="submit" name="cariwtn">Cari</button>
        </div></form>';
    if(isset($_POST['cariwtn'])){  
        $tanggal=$_POST["tanggal"];
        $bulan=$_POST["bulan"];
        $tahun=$_POST["tahun"]; 
        $arr = array($tahun, $bulan, $tanggal); //1984-05-17
        $tang=implode("-",$arr);
        $namahari = date('l', strtotime($tang));
        $neptuhari = date('l', strtotime($tang));
    
        // proses mencari selisih hari antara kedua tanggal 
        $pecah1 = explode("-", $tgl1);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0];
        
        $pecah2 = explode("-", $tang);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 =  $pecah2[0];
        
        $jd1 = GregorianToJD($month1, $date1, $year1);
        $jd2 = GregorianToJD($month2, $date2, $year2);
        
        $selisih = $jd2 - $jd1;
        
        // hitung modulo 5 dari selisih harinya
        $mod = $selisih % 5;
        $totalnep=$nepdino[$neptuhari]+$neppas[$mod];      
        $string .='<hr/>
        <div style="text-align:center">Pasaran dari tanggal:
            <strong>'. date_i18n('j F Y', strtotime($tang)).'</strong> adalah: <strong>'. $dino[$namahari]. ' ' .$pasaran[$mod].',</strong> dengan neptu: <strong>'.$totalnep.'</strong><div>';
    }
    // Ad code returned
    return $string; 
     
    }
    // Register shortcode
    add_shortcode('weton-jawa', 'weton_shortcode');

?>


