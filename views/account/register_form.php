<div class="container">
	<div class="col-md-4 offset-md-4 text-center">
		<h2>My Coin Kayıt Ol</h2>
	</div>
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<form id="register_form">
				<div class="form-group">
					<label for="username">Kullanıcı Adı</label>
					<input type="text" name="username" id="username" class="form-control" placeholder="Kullanıcı Adı">
				</div>
				<div class="form-group">
					<label for="password">Şifre</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Şifre">
				</div>
				<div class="form-group">
					<label for="sifre">Tekrar</label>
					<input type="password" name="confirm" id="confirm" class="form-control" placeholder="Şifre Tekrarı">
				</div>
				<div class="text-right">
					<a href="/index.php?path=login">Zaten Kayıtlıyım</a>
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