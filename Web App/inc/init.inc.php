<?php
// Start Time, used for performance testing.
define('started', microtime());

// Max out error reporting.
error_reporting(-1);

// Define Database Variables
define('db_host', 'localhost');
define('db_database', 'fullonde_voteapp');
define('db_database_salt', 'j6fm');
define('db_username', 'fullonde_voteapp');
define('db_password', 'TI{-knt+$ZbETBo!DS');

// Cache information
define('cache_dir', '../cache');

// Start Sessions
//session_name();
//session_start();

// Include all the required files.
require('db.class.php');
require('vote.class.php');
?>