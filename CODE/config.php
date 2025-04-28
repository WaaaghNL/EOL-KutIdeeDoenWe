<?php

DB::$user = 'kutideedoenwe';
DB::$password = 'PASSWORD';
DB::$dbName = 'kutideedoenwe';

$siteBase = "https://kutideedoenwe.nl/";
$siteTitle = "Kut idee! Doen we?";
$siteCopyright = "&copy; 2023";

$resultAwnserTRUE = array(
    'title' => 'KUT IDEE!',
    'msg' => 'Moet je doen!',
);
$resultAwnserFALSE = array(
    'title' => 'Sorry!',
    'msg' => 'Sommige kut ideeën zijn gewoon niet kut genoeg!',
);

function genKey() {
    $key = substr(uniqid(), -8);
    //Select from

    $keyCount = DB::query("SELECT ideakey FROM ideas WHERE ideakey=%s", $key);
    if (count($keyCount) === 0) {
        return $key;
    }
    else {
        genKey();
    }
}

function getIPAddress() {
    //whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
//whether ip is from the remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function is_hex($hex_code) {
    return @preg_match("/^[a-f0-9]{2,}$/i", $hex_code) && !(strlen($hex_code) & 1);
}

$key = genKey();
$ip = getIPAddress();
