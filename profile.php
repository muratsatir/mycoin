<?php
global $user;

if(is_login()){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username=trim($_POST['username']);
		$password=trim($_POST['password']);
		$email=trim($_POST['email']);

		$query = $db->prepare("UPDATE user SET username=:username WHERE id=:id");
		$query->bindParam(':id', $user->id, PDO::PARAM_INT);
		$query->execute();		

		if($email!=''){
			$query = $db->prepare("UPDATE user SET password=:password WHERE id=:id");
			$query->bindParam(':id', $user->id, PDO::PARAM_INT);
			$query->execute();		
		}

		$query = $db->prepare("UPDATE profile SET email=:email WHERE user_id=:user_id");
		$query->bindParam(':user_id', $user->id, PDO::PARAM_INT);
		$query->execute();	

		$result['success']=true;
		$result['message']="Profiliniz başarılı bir şekilde güncellendi.";
		echo json_encode($result);
		
	}else{		
		require_once('./views/common/header.php');
		require_once('./views/account/profile_form.php');
		require_once('./views/common/footer.php');
	}
}else{
	header('Location: /index.php?path=login'); 
}
