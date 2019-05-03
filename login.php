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
		$query->setFetchMode(PDO::FETCH_OBJ);

		$result['success']=false;
		$result['message']="Kullanıcı adı veya şifreniz yanlış. Lütfen kontrol ederek yeniden deneyiniz";
		if(isset($query->username) && $query->username==$username){
		   $result['success']=true;			
		   $result['redirect']='/index.php?profile';			
		}	
		echo json_encode($result);
	}else{		
		require_once('./views/common/header.php');
		require_once('./views/account/login_form.php');
		require_once('./views/common/footer.php');
	}
}