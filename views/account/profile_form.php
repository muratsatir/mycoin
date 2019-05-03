<div class="container">
	<div class="col-md-4 offset-md-4 text-center">
		<h2>My Coin Profilim</h2>
	</div>
	<div class="row">
		<div class="col-md-4 offset-md-4">
		    <div class="text-right">
				<a href="/index.php?path=wallet" class="btn btn-primary">Cüzdanım</a>
				<a href="/index.php?path=logout" class="btn btn-primary">Çıkış</a>
			</div>
			<form id="profile_form">
				<div class="form-group">
					<label for="username">Kullanıcı Adı</label>
					<input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username  ?>" placeholder="Kullanıcı Adı" />
				</div>
				<div class="form-group">
					<label for="password">Şifre</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Şifre" />
				</div>
				<div class="form-group">
					<label for="eposta">E-Posta</label>
					<input type="email" class="form-control" id="email" name="email" value="<?php echo $user->profile->email ?>" placeholder="E-Posta" />
				</div>
				<button type="submit" class="btn btn-primary">Kaydet</button>
			</form>
		</div>
	</div>
</div>
<script src="/assets/vendor/jquery-validation-1.19.0/jquery.validate.min.js"></script>
<script src="/assets/vendor/jquery-validation-1.19.0/additional-methods.min.js"></script>
<script src="/assets/vendor/jquery-validation-1.19.0/localization/messages_tr.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		form_action.profile_update();
	});
</script>