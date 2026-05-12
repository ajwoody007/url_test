<?php


    // turn off before submitting to tfli
    ini_set('display_errors', 1);
    // error_reporting(E_ALL);

/* this is the front end "model" class file */

class tfli_mdl {

    public function create_database_db():void {

        // I decided to send the app without a db or db folder, so the first thing it must
        // do is to create them both. It does this on every run (like a framework does)
        // if the folder or file exists, this commands are ignored

        $success = exec("ls -l database");
        if (!$success) {
            exec("mkdir database");
            exec("chmod database 0777"   );
        }

        $db = new PDO('sqlite:database/tfli.db');
        $create_table = "CREATE TABLE IF NOT EXISTS short_urls (
                url_id INTEGER PRIMARY KEY AUTOINCREMENT,
                url_title TEXT NULL,
                url_add TEXT NULL,
                url_expiry datetime NULL,
                url_short TEXT NULL
                );";

        $db->exec($create_table);
        return;

    }

    public function insert_new_url($url_data, $short_url): void {

        // unravel the JSON array

        $url_title = $url_data['url_title'];
        $url_add = $url_data['url_add'];
        $url_expiry = $url_data['url_expiry'];

        if ($url_expiry) {

            $url_expiry_dt = DateTime::createFromFormat('d/m/Y H:i', $url_expiry);
            $url_expiry_db = $url_expiry_dt->format('Y-m-d H:i');        

        } else {

            $url_expiry_db = '';        

        }

        $db = new PDO('sqlite:database/tfli.db');

        $query = $db->prepare('
            INSERT INTO short_urls (url_title, url_add, url_expiry, url_short) 
            VALUES (:title, :url, :expiry, :short)
        ');

        $query->execute([
            ':title'  => $url_title,
            ':url'    => $url_add,
            ':expiry' => $url_expiry_db,
            ':short'  => $short_url,
        ]);

        return;

    }

    public function get_short_urls_db() {

        $db = new PDO('sqlite:database/tfli.db');
        $get_data = "SELECT *, strftime('%d/%m/%Y %H:%M', url_expiry) AS url_expiry_date FROM short_urls ORDER BY url_expiry DESC;";
        $exec_cmd = $db->query($get_data);
        $result = $exec_cmd->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function check_url_db($short_url) {

        date_default_timezone_set('Europe/London');
        $expiry_time = new DateTime();

        $db = new PDO('sqlite:database/tfli.db');
        $get_data = "SELECT url_add FROM short_urls 
                    WHERE url_short = '" . $short_url . "' 
                    AND (url_expiry >= '" . $expiry_time->format('Y-m-d H:i') . "' OR url_expiry = '');";

        $exec_cmd = $db->query($get_data);
        $url = $exec_cmd->fetchAll(PDO::FETCH_ASSOC);
        
        return $url;

    }

}
