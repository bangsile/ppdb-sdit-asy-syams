<?php

use Carbon\Carbon;

if (!function_exists('format_tanggal')) {
    function format_tanggal($tanggal, $format = 'd F Y')
    {
        return Carbon::parse($tanggal)
            ->locale('id')       // pakai locale Indonesia
            ->translatedFormat($format); // format sudah diterjemahkan
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($number)
    {
        return 'Rp' . number_format($number, 0, ',', '.');
    }
}
