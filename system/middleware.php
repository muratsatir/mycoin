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
		$profile_query->execute();
		$profile_detail=$profile_query->fetchObject();

		$user->profile = new stdClass();
		$user->profile->email=(isset($profile_detail->email))?$profile_detail->email:'';
		$user->profile->wallet=$profile_detail->wallet;
		$user->profile->admin=$profile_detail->admin;

		$user_wallet=$user->profile->wallet;
		$wallet_query=$db->prepare("SELECT (SELECT SUM(amount) AS total FROM transactions WHERE to_wallet=:wallet) AS in_amout, (SELECT SUM(amount) AS total FROM transactions WHERE from_wallet=:wallet) AS out_amount FROM transactions LIMIT 1");
		$wallet_query->bindParam(':wallet', $user_wallet, PDO::PARAM_STR);
		$wallet_query->execute();
		$wallet_query_detail=$wallet_query->fetchObject();

		$user->wallet = new stdClass();
		$user->wallet->total=(float)$wallet_query_detail->in_amount-(float)$wallet_query_detail->out_amount;
		$user->wallet->in_amount=(float)$wallet_query_detail->in_amount;
		$user->wallet->out_amount=(float)$wallet_query_detail->out_amount;
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