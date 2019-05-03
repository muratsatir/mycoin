<?php
function is_login(){
	global $db;
	global $user;
	if(isset($_SESSION['user_id']) && (int)$_SESSION['user_id']>0){
		
		$user_id=(int)$_SESSION['user_id'];
		
		$user_query=$db->prepare("SELECT * FROM user WHERE id=:id");
		$user_query->bindParam(':id', $user_id, PDO::PARAM_STR);			
		$user_query->execute();	
		$user_detail=$user_query->fetchObject();
		
		$user->id=$user_detail->id;
		$user->username=$user_detail->username;
		
		$profile_query=$db->prepare("SELECT * FROM user_profile WHERE user_id=:user_id");
		$profile_query->bindParam(':user_id', $user_id, PDO::PARAM_STR);		
		$profile_query->setFetchMode(PDO::FETCH_OBJ);
		$profile_detail=$profile_query->fetchObject();		
		
		$user->profile = new stdClass();
		$user->profile->email=(isset($profile_detail->email))?$profile_detail->email:'';		
		
		return true;
	}
	else{
		$user=new stdClass();
		return false;
	}
}
function logout(){
	global $user;
	
	unset($_SESSION['user_id']);
	
	$user=new stdClass();
}	