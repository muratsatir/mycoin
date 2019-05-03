<?php
if(is_login()){
	header('Location: /index.php?path=profile');
}else{
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username=trim($_POST['username']);
		$password=trim($_POST['password']);

		$query = $db->prepare("SELECT * FROM user WHERE username=:username and password=:password");
		$query->bindParam(':username', $username, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->execute();
		$user_detail=$query->fetchObject();

		$result['success']=false;
		$result['message']="Kullanıcı adı veya şifreniz yanlış. Lütfen kontrol ederek yeniden deneyiniz";
		if(isset($user_detail->username) && $user_detail->username==$username){
			$_SESSION['user_id']=$user_detail->id;
		   $result['success']=true;
		   $result['redirect']='/index.php?path=profile';
		}
		echo json_encode($result);
	}else{
		require_once('./views/common/header.php');
		require_once('./views/account/login_form.php');
		require_once('./views/common/footer.php');
	}
}