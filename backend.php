<?php

function http_request($url){
    // persiapkan curl
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // set user agent    
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // tutup curl 
    curl_close($ch);      

    // mengembalikan hasil curl
    return $output;
}

function indeksKualitasUdara($aqius) {
    $kualitasUdara = " ";

    if ($aqius >=0 && $aqius <= 50) {
        $kualitasUdara = "Baik";
    } else if ($aqius <= 100) {
        $kualitasUdara = "Sedang";
    } else if ($aqius <= 200) {
        $kualitasUdara = "Tidak Sehat";
    } else if ($aqius <= 300) {
        $kualitasUdara = "Sangat Tidak Sehat";
    } else {
        $kualitasUdara = "Berbahaya";
    }

    return $kualitasUdara;
}

function cuaca($ic) {
    $image = " ";
    $keterangan = " ";

    $ic = trim($ic);
    
    if($ic == "01d") {
        $image = "https://www.airvisual.com/images/01d.png";
        $keterangan = "clear sky (day)";
    } else if($ic == "01n") {
        $image = "https://www.airvisual.com/images/01n.png";
        $keterangan = "clear sky (night) ";
    } else if($ic == "02d") {
        $image = "https://www.airvisual.com/images/02d.png";
        $keterangan = "few clouds (day) ";
    } else if($ic == "02n") {
        $image = "https://www.airvisual.com/images/02n.png";
        $keterangan = "few clouds (night) ";
    } else if($ic == "03n") {
        $image = "https://www.airvisual.com/images/03d.png";
        $keterangan = "scattered clouds";
    } else if($ic == "04n") {
        $image = "https://www.airvisual.com/images/04d.png";
        $keterangan = "broken clouds";
    } else if($ic == "09n") {
        $image = "https://www.airvisual.com/images/09d.png";
        $keterangan = "shower rain";
    } else if($ic == "10d") {
        $image = "https://www.airvisual.com/images/10d.png";
        $keterangan = "rain (day time)";
    } else if($ic == "10n") {
        $image = "https://www.airvisual.com/images/10n.png";
        $keterangan = "rain (night time) ";
    } else if($ic == "11n") {
        $image = "https://www.airvisual.com/images/11d.png";
        $keterangan = "thunderstorm";
    } else if($ic == "13n") {
        $image = "https://www.airvisual.com/images/13d.png";
        $keterangan = "snow";
    } else if($ic == "50n") {
        $image = "https://www.airvisual.com/images/50d.png";
        $keterangan = "mist";
    }

    return array("image" => $image, "keterangan" => $keterangan);
}
?>