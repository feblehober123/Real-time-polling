<?php
// Get the pages variables set up
require('../inc/init.inc.php');

// Connect to the database, if it fails leta assume the database isn't installed
try {	
  $db = new db('mysql:host='.db_host.';dbname='.db_database,db_username,db_password);
} catch (Exception $e) {
   die('<h1>Need to Install</h1><p>The database is not installed. <a href="install.php">Visit the installer to install it.</a></p>');
}
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // Turn on db errors, so we can debug.

if(isset($_POST['option_name']) && isset($_POST['option_sessionid'])) {
  vote::addOption($_POST['option_name'], $_POST['option_sessionid']);
} else {
  echo vote::getLastOptionAddTime();
}
?>
