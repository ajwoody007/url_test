<?php

    // // turn off before submitting to tfli
    // ini_set('display_errors', 1);
    // error_reporting(E_ALL);

    // connect to controller to make sure the db exists
    include ("tfli_ctl.php");
    $obj_ctl = new tfli_ctl();  
    $success = $obj_ctl->create_database();
    $short_urls = $obj_ctl->get_short_urls();

    // Sets the default timezone to Europe/London and add a default expiry time of 10 minutes from now
    date_default_timezone_set('Europe/London');
    $expiry_date_now = new DateTime();
    $expiry_date = $expiry_date_now->modify("+ 10 minutes");

?>

    <body>

        <span class="flex justify-center w-full text-2xl font-bold bg-teal-300 p-6">TFLI Technical Test - Andy Wood</span>
        <span class="flex justify-center w-full bg-teal-300 p-2">Enter a web address, title and expiry date/time into the fields below</span>
        <span class="flex justify-center w-full bg-teal-300 p-2">Then click create to get a shortened URL</span>

        <div class="w-[70%] pl-[35%] mt-12">

            <span class="flex m-4">
                <label class="p-3 block w-[200px] font-bold">URL Title:</label>
                <input type="text" class="border border-gray-800 rounded-lg p-3 w-[300px]" placeholder="Yahoo" id="txtTitle"/>
            </span>

            <span class="flex m-4">
                <label class="p-3 block w-[200px] font-bold">URL:</label>
                <input type="text" class="border border-gray-800 rounded-lg p-3 w-[300px]" placeholder="www.yahoo.co.uk" id="txtUrl"/>
            </span>

            <span class="flex m-4">
                <label class="p-3 block w-[200px] font-bold">Expiry Date/Time:</label>
                <input type="text" class="border border-gray-800 rounded-lg p-3 w-[300px]" value="<?= $expiry_date->format('d/m/Y H:i'); ?>" id="txtExpiry"/>            
            </span>

            <span class="flex w-full  justify-center">
                <button class="p-3 border bg-teal-300 font-bold rounded-lg" onclick="val_url()">CREATE</button>
            </span>

        </div>

        <!-- if any short codes exist already, display them here (the actual url need not be shown, it's here for data checking)  -->

        <?php if($short_urls) { ?> 

        <hr class="mt-6 mb-6">

        <span class="w-full m-6 font-bold">Previously created short codes</span>

        <div class="w-full m-6">

            <table class="flex justify-start w-full">

                <th class="w-[250px] text-left">Title</th>
                <th class="w-[250px] text-left">URL</th>
                <th class="w-[250px] text-left">Short URL</th>
                <th class="w-[250px] text-left">Expiry</th>

                <tr><td colspan=5><hr></td></tr>
                
                <?php 

                foreach ($short_urls as $row) {

                    echo "<tr>";

                    echo "<td>" . $row['url_title'] . "</td>";
                    echo "<td>" . $row['url_add'] . "</td>";
                    echo "<td>" . $row['url_short'] . "</td>";
                    echo "<td>" . $row['url_expiry_date'] . "</td>";

                    echo "</tr>";

                }

                ?>

            </table>

        </div>

        <?php } ?>

    </body>

    </html>
