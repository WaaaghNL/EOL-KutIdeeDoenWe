<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

if (isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['idea']) && $_POST['idea'] != "") {

    // This is Google API url where we pass the API secret key to validate the user request.
    $google_recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret_key = 'SECURITY_KEY'; // Add your generated Secret key
    // Make the request and capture the response by making below request.
    $get_recaptcha_response = file_get_contents($google_recaptcha_url . '?secret=' . $recaptcha_secret_key . '&response=' . $_POST['recaptcha_response']);

    $get_recaptcha_response = json_decode($get_recaptcha_response);
    $success_msg = "";
    $err_msg = "";
    // Set the Google recaptcha spam score here and based the score, take your action
    if ($get_recaptcha_response->success == true && $get_recaptcha_response->score >= 0.5 && $get_recaptcha_response->action == 'submit') {
        if (rand(1, 5) != 4) {
            $success_msg = "<h3>" . $resultAwnserTRUE['title'] . "</h3><p>" . $resultAwnserTRUE['msg'] . "</p>";
            $success_status = true;
        }
        else {
            $success_msg = "<h3>" . $resultAwnserFALSE['title'] . "</h3><p>" . $resultAwnserFALSE['msg'] . "</p>";
            $success_status = false;
        }
        $success_msg .= '<h3>Share</h3>';
        $success_msg .= '<p><input type="text" class="form-control" value="' . $siteBase . $key . '"></p>';

// Naam, idee, status, ip
        // https://www.etutorialspoint.com/index.php/424-php-sanitize-input-for-mysql
        DB::insert('ideas', [
            'ideakey' => $key,
            'name' => filter_var($_POST['name'], FILTER_SANITIZE_STRING),
            'idea' => htmlentities($_POST['idea'], ENT_QUOTES, 'UTF-8'),
            'status' => $success_status,
            'ipv4' => $ip,
        ]);
    }
    else {
        $err_msg = "<h5>Error!</h5><p>Iets ging er verkeerd! Probeer het later nog eens!</p>";
    }
}
else {
    $err_msg = "<h5>Error!</h5><p>Even alles invullen! Ut is nie zo moeilijk...</p>";
}
// Get the response and pass it into your ajax as a response.
$return_msg = array(
    'error' => $err_msg,
    'success' => $success_msg
);
header('Content-Type: application / json; charset = utf-8 ');
echo json_encode($return_msg, true);
?>