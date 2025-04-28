<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

$key = explode('/', substr($_SERVER['SCRIPT_URL'], 1))[0];

if (isset($key) AND is_hex($key) AND strlen($key) === 8) {
    $ideas = DB::query("SELECT * FROM ideas WHERE ideakey=%s0", $key);
    if (count($ideas) === 1) {
        $idea = $ideas[0];
        require_once 'show.php';
    }
    else {
        header('Location: ' . $siteBase);
    }
}
elseif (isset($key) AND $key === "KEYKEYKEY") {
    require_once 'list.php';
}
else {
    require_once 'idea.php';
}