<?php
if(is_login()){
	header('Location: /index.php?path=profile');
}else{
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$result=array();
		try{
			$username=trim($_POST['username']);
			$password=trim($_POST['password']);
			$add_date=date("Y-m-d H:i:s");

			$query = $db->prepare("INSERT INTO user SET username=:username, password=:password");

			$query->bindParam(':username', $username, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->bindParam(':add_date', $add_date, PDO::PARAM_STR);

			$query->execute();

			$user_id=$query->lastInsertId();

			$user_wallet=md5(date("Y-m-d H:i:s").uniqid());

			$profile_query= $db->prepare("INSERT INTO profile SET user_id:user_id, wallet=:wallet");
			$profile_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$profile_query->bindParam(':wallet', $user_wallet, PDO::PARAM_STR);
			$profile_query->execute();

			$_SESSION['user_id']=$user_id;
			$result['success']=true;
			$result['redirect']='/index.php?path=profile';

		}catch(Exception $e){
			$result['success']=false;
			$result['error']="Kayıt işlemi sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz. Hata:"+$e;
		}

	}else{
		require_once('./views/common/header.php');
		require_once('./views/account/register_form.php');
		require_once('./views/common/footer.php');
	}
}