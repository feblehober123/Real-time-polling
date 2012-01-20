<?php
class vote{
	public static function addVote($vote_for='Mike', $vote_sessionid='unknown-device', $vote_topicID=1){
		global $db;
		
		// Wipe all the old votes by this person:
		$values = array('voter_sessionid'=>$vote_sessionid);
		$db->prepare('DELETE FROM '.$db->tableName('votes').' '.$db->where($values).';')
			->execute($db->bind($values));
		
		// Add new vote
		$values = array('vote_for' => $vote_for, 'voter_sessionid'=>$vote_sessionid, 'vote_topicID'=>$vote_topicID);	
		$db->prepare('INSERT INTO '.$db->tableName('votes').' '.$db->insert($values).';')
			->execute($db->bind($values));
	}
	
	public static function getVotes($vote_topicID=1){
		global $db;
		
		$values = array('vote_topicID' => $vote_topicID);	
			
		$query = $db->prepare('SELECT * FROM '.$db->tableName('votes').' '.$db->where($values).' ORDER BY `vote_time` DESC;');
		$query->execute($values);
		return $query->fetchAll(PDO::FETCH_ASSOC);
		 
	}
	
	public static function getVotesCounts($vote_topicID=1){
		global $db;
		
		$values = array('vote_topicID' => $vote_topicID);	
			
		$query = $db->prepare('SELECT `vote_for`, COUNT(*) AS `vote_for_count` FROM '.$db->tableName('votes').' '.$db->where($values).' GROUP BY vote_for;');
		$query->execute($values);
		return $query->fetchAll(PDO::FETCH_ASSOC);
		 
	}
	
	public static function getLastVoteTime($vote_topicID=1){
		global $db;
		
		$values = array('vote_topicID' => $vote_topicID);
	
		$query = $db->prepare('SELECT `vote_time` FROM '.$db->tableName('votes').' '.$db->where($values).' ORDER BY `vote_time` DESC LIMIT 0,1;');
		$query->execute($values);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result[0]['vote_time'];
	}
	
}
?>