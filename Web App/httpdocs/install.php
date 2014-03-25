<!doctype html> 
<html lang="en"> 
<head>
	<meta charset="UTF-8"> 
	<title>VoteApp - Installer</title>
</head>
<body>
<?php # this page installs the database.

// Get the pages variables set up
require('../inc/init.inc.php');

echo '<h1>Installing</h1><ul>';

// Clean up any spare sessions
echo '<li>Clearing up sessions.</li>';

echo '<li>Connecting &amp; creating the Database</li>';

// Connect to the database
$db = new db('mysql:host='.db_host.';',db_username,db_password); 

// Create the Database
$db->createDatabase(db_database);

// Turn on error warnings.
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 

// Install the database structure - TODO improve database.
echo '<li>Building database Structure</li>';

$db->exec('
CREATE TABLE  '.$db->tableName('votes').' (
`vote_ID` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`vote_for` VARCHAR( 255 ) NOT NULL ,
`voter_sessionid` VARCHAR( 255 ) NOT NULL ,
`vote_topicID` INT NOT NULL DEFAULT 0,
`vote_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;
');

$db->exec('
CREATE TABLE  '.$db->tableName('options').' (
`option_ID` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`option_name` VARCHAR(255) NOT NULL,
`option_sessionid` VARCHAR(255) NOT NULL,
`option_topicID` INT NOT NULL DEFAULT 0,
`option_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = INNODB;
');
echo '</ul>';
echo '<p>Install finished. </p>
<p>Its a good idea to delete this file (or hide it) so your website is not reinstalled.</p>';
?>
</body>
</html>
