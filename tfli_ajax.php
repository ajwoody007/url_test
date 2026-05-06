<?php

/* this is the front end "controller" AJAX file (not a controller class, but the link between js and php) */

    include ("tfli_mdl.php");
    $obj_db = new tfli_mdl();  

    $code_action = $_POST['code_action'];

    switch ($code_action) {

        case 'reduce_url':

            // create a random text string and return that to the display

            $random_string = random_bytes(3);
            $short_url = bin2hex($random_string);

            // now connect to the model and add the data to the $db

            $url_data = $_POST['url_data'];
            $success = $obj_db->insert_new_url($url_data, $short_url);

            // call a function to connect to the db and add the data

            return;

    }

