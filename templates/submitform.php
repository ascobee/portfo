<?php
    $public_key = "6LfF97AZAAAAAIBLplqgrOoI4AKPgE6lA85KzKY5";
    $private_key = "6LfF97AZAAAAANYUuSKcJgRZNockh9JaagDLjMtq";
    $recaptcha_api_url = "https://www.google.com/recaptcha/api/siteverify";

    $success_url = "https://www.austinscobee.com/thankyou.html";
    $error_url = "https://www.austinscobee.com/formerror.html";
    $send_email_url = "https://www1.domain.com/scripts/formemail.html";

    $response_token = $_POST['g-recaptcha-response'];
    $user_ip_address = $_SERVER['REMOTE_ADDR'];

    function redirect($url)
    {
        ob_start();
        header("Location: ".$url);
        ob_end_flush();
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$recaptcha_api_url");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'secret' => $private_key,
        'response' => $response_token,
        'remoteip' => $user_ip_address
    ]);
    $api_response = json_decode(curl_exec($ch));
    curl_close($ch);

    if ($api_response->success == 1) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $send_email_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_exec($ch);
        curl_close($ch);
        redirect($success_url);
    } else {
        redirect($error_url);
    }
