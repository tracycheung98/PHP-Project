<?php

// set the folder path for the image files
define("IMAGES",'./images/');


// Set all the database things! double check with the PDOWrapper class and your database 
define("DB_HOST", "172.17.0.3");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "Project");
define("DB_PORT", "3306");

// Set the error log things!
define('LOGFILE','log/error_log.txt');
ini_set("log_errors", TRUE);
ini_set('error_log', LOGFILE);

?>