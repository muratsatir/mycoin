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
			/**
			 * Kullanıcı adının daha önce kayıtlı olup olmadığı kontrol ediliyor
			 */
			$user_check_query=$db->prepare("SELECT COUNT(id) as total FROM user WHERE username=:username");
			$user_check_query->bindParam(':username', $username, PDO::PARAM_STR);
			$user_check_query->execute();
			$user_check=$user_check_query->fetchObject();

			if((int)$user_check->total==0){
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
			}else{
				$result['success']=false;
				$result['error']="Bu kullanıcı adı zaten kayıtlı.";
			}

		}catch(Exception $e){
			$result['success']=false;
			$result['error']="Kayıt işlemi sırasında bir hata oluştu. Lütfen daha sonra tekrar deneyiniz. Hata:"+$e;
		}
		echo json_encode($result);
	}else{
		require_once('./views/common/header.php');
		require_once('./views/account/register_form.php');
		require_once('./views/common/footer.php');
	}
}