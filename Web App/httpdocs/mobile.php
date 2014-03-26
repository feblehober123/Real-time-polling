<?php
	require('../inc/init.inc.php');
?>		
<!DOCTYPE html> 
<html> 
	<head> 
	<title>VoteApp</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="jquery-mobile/jquery.mobile-1.0.min.css" />
	<link rel="stylesheet" href="jquery-mobile/jquery.mobile.simpledialog.min.css" />
	
	<script type="text/javascript" src="jquery-mobile/jquery.js"></script>
	<script type="text/javascript" src="jquery-mobile/jquery.mobile-1.0.min.js"></script>
	<script type="text/javascript" src="jquery-mobile/jquery.mobile.simpledialog.min.js"></script>
</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<h1>VoteApp</h1>
	</div><!-- /header -->

	<div data-role="content">	
	<p>Select someone from the list below to vote for them.</p>
	<br />
		<ul data-role="listview" data-inset="true" data-filter="true" id="people-list">
			<?php
			//Connect to db, else assume DB isn't installed.
			try {
				$db = new db('mysql:host='.db_host.';dbname='.db_database,db_username,db_password);
			}catch (Exception $e) {
				die('<h1>Need to Install</h1><p>The database is not installed. <a href="install.php">Visit the installer to install it.</a></p>');
			}
			
			$options = vote::getOptions();
			foreach($options as $key) {
				echo("<li><a href='#'>$key</a></li>");
			}
			?>
			<li><input id="option-name" type="text" /><button id="option-submit">submit option</button></li>
		</ul>
	</div><!-- /content -->

</div><!-- /page -->
<script type="text/javascript">
var clickedButton = false;

if(localStorage.UUID == undefined){
	localStorage.UUID = Math.floor(Math.random()*10000000);
}

$('#people-list a').bind('click', function(){
	clickedButton = $(this);
	localStorage.vote_for = $(this).text();
	$.ajax({
	  type: 'POST',
	  url: '/vote.php',
	  data: 'vote_for='+localStorage.vote_for+'&vote_sessionid=web-'+localStorage.UUID,
	  success: function(data){
	  	clickedButton.simpledialog({
	        'mode' : 'blank',
	        'prompt': false,
	        'forceInput': false,
	        'useModal':true,
	        'fullHTML' : "<p>Vote set to: "+localStorage.vote_for+"</p><a rel='close' data-role='button' href='#' id='simpleclose'>Close</a>"
	    });
	  },
	  dataType: 'html'
	});
	 
});

$('#option-submit button').bind('click', function() {
	localStorage.optionName = html.getElementById('option-name').value;
	$.ajax({
	  type: 'POST',
	  url: '/option.php',
	  data: 'option_name='+localStorage.optionName+'&option_sessionid=web-'+localStorage.UUID,
	  success: function(data){
	  	clickedButton.simpledialog({
	        'mode' : 'blank',
	        'prompt': false,
	        'forceInput': false,
	        'useModal':true,
	        'fullHTML' : "<p>Vote set to: "+localStorage.option_name+"</p><a rel='close' data-role='button' href='#' id='simpleclose'>Close</a>"
	    });
	  },
	  dataType: 'html'
	});
});
</script>
</body>
</html>
