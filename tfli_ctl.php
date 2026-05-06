<?php

/* this is the back end "controller" class file */

    include ("tfli_mdl.php");

    class tfli_ctl {

        public function create_database(): void {

            $obj_db = new tfli_mdl();  
            $success = $obj_db->create_database_db();

            return;

        }

        public function get_short_urls() {

            $obj_db = new tfli_mdl();  
            $short_urls = $obj_db->get_short_urls_db();

            return $short_urls;

        }

        public function check_url($short_url) {

            $obj_db = new tfli_mdl();  
            $url = $obj_db->check_url_db($short_url);

            return $url;

        }

    }
