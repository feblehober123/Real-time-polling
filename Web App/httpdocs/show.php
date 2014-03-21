<?php
// Get the pages variables set up
require('../inc/init.inc.php');

// Connect to the database, if it fails leta assume the database isn't installed
try {
	$db = new db('mysql:host='.db_host.';dbname='.db_database,db_username,db_password);
}catch (Exception $e) {
    die('<h1>Need to Install</h1><p>The database is not installed. <a href="install.php">Visit the installer to install it.</a></p>');
}
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // Turn on db errors, so we can debug.
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>VoteApp</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="css/style.css">
  <link href="css/basic.css" type="text/css" rel="stylesheet" />
  <link href="css/visualize.css" type="text/css" rel="stylesheet" />
  <!-- end CSS-->

  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

  <div id="container">
    <header>

    </header>
    <div id="main" role="main">
    
    <table id="voteResults">
		<caption>Top VoteApp Demo Person!</caption>
		<thead>
			<tr>
				<th scope="col">Person</th>
				<th scope="col">Votes</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$voteOptions = vote::getOptions();
				$votesCounts = vote::getVotesCounts();
				if(is_array($votesCounts)){foreach($votesCounts as $votesCount){
					unset($voteOptions[$votesCount["vote_for"]]);
					?>
			<tr>
				<th scope="row"><?php echo $votesCount["vote_for"]; ?></th>
				<td><?php echo $votesCount["vote_for_count"]; ?></td>
			</tr>
					<?php 
				}}
				
				if(is_array($voteOptions)){foreach($voteOptions as $name => $voteOption){
					?>
			<tr>
				<th scope="row"><?php echo $name; ?></th>
				<td>0</td>
			</tr>
					<?php
				}}
			?>
			
		</tbody>
	</table>
    
    <?php
		//$votes = vote::getVotes();
		//var_dump($votes);

		//var_dump($votesCounts);
	?>
	
	<div id="last_vote_time"><?php echo vote::getLastVoteTime(); ?></div>
	<div id="last_option_add_time"><?php echo vote::getLastOptionAddTime(); ?></div>
    	
    </div>
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/mylibs/visualize.jQuery.js"></script>
  <script defer src="js/script.js"></script>
  <!-- end scripts-->


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
