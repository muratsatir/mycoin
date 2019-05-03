<?php
if(is_login()){
	header('Location: /index.php?path=profile');
}else{
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$result=array();
		try{
			$username=trim($_POST['username']);
			$password=trim($_POST['password']);

			$query = $db->prepare("INSERT INTO user SET username=:username, password=:password");

			$query->bindParam(':username', $username, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);

			$query->execute();

			$_SESSION['user_id']=$db->lastInsertId();
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