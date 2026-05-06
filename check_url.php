<?php

    // call the model file, via a controller, to connect to the db and check if the short code exists and if it does, redirect to the full url
    // if it doesn't, redirect to a pretty 404 page

    $full_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $short_url = $_GET['short_url'];
    $valid_page = false;
    $returned_url = "";
    $code = 0;

    include ("tfli_ctl.php");
    $obj_ctl = new tfli_ctl();  
    $url = $obj_ctl->check_url($short_url);

    // check the url actually exists

    if ($url) {
       
        $returned_url = "https://" . $url[0]['url_add'];
        $full_url = curl_init($returned_url);
        curl_setopt($full_url, CURLOPT_NOBODY, true);        // HEAD request, don't download body
        curl_setopt($full_url, CURLOPT_FOLLOWLOCATION, true); // follow redirects
        curl_setopt($full_url, CURLOPT_TIMEOUT, 5);           // don't wait too long
        curl_exec($full_url);
        $code = curl_getinfo($full_url, CURLINFO_HTTP_CODE);  
    }

    if ($code >= 200 ) { $valid_page = true; }

    if ($valid_page) {
        header("location:" . $returned_url);
    } else {
        header( 'Location: 404.php' ) ;
    }


