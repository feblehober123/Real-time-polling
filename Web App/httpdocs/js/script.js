/* Author: 

*/

$('#voteResults').visualize({type: 'pie', height: '300px', width: '420px'});
var last_vote_time = $("#last_vote_time").text();

function checkForVotes(){
	$.ajax({
	  type: 'GET',
	  url: '/vote.php',
	  success: function(data){
	  	if(data != last_vote_time){
	  		history.go(0)
	  	}else{
	  		setTimeout('checkForVotes();', 3500)
	  	}
	  },
	  dataType: 'html'
	});
}

$(document).ready(function(){
	checkForVotes();
});