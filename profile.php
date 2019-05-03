<?php
global $user;

if(is_login()){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username=trim($_POST['username']);
		$password=trim($_POST['password']);
		$email=trim($_POST['email']);

		$user_id=$user->id;

		$query = $db->prepare("UPDATE user SET username=:username WHERE id=:id");
		$query->bindParam(':username', $username , PDO::PARAM_STR);
		$query->bindParam(':id', $user_id , PDO::PARAM_INT);
		$query->execute();

		if($password!=''){
			$query = $db->prepare("UPDATE user SET password=:password WHERE id=:id");
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->bindParam(':id', $user_id, PDO::PARAM_INT);
			$query->execute();
		}
		if($email!=''){
			$query_count=$db->prepare("SELECT COUNT(id) as total FROM user_profile WHERE user_id=:user_id");
			$query_count->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$query_count->execute();
			$count_detail=$query_count->fetchObject();

			if((int)$count_detail->total>0){
				$query = $db->prepare("UPDATE user_profile SET email=:email WHERE user_id=:user_id");
				$query->bindParam(':email', $email, PDO::PARAM_STR);
				$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$query->execute();
			}else{
				$query = $db->prepare("INSERT INTO user_profile SET email=:email, user_id=:user_id");
				$query->bindParam(':email', $email, PDO::PARAM_STR);
				$query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$query->execute();
			}
		}

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
