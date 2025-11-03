<?php
function parse_date($datetime, $show_time = true){
    
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $timestamp = strtotime($datetime);
    $tgl = date('j', $timestamp);
    $bln = $bulan[(int)date('n', $timestamp)];
    $thn = date('Y', $timestamp);

    if ($show_time) {
        $jam = date('H:i', $timestamp);
        return "$tgl $bln $thn, $jam";
    }

    return "$tgl $bln $thn";
}