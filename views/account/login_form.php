<div class="container">
	<div class="col-md-4 offset-md-4 text-center">
		<h2>My Coin Giriş Yap</h2>
	</div>
	<div class="row">
		<div class="col-md-4 offset-md-4">
			<form id="login_form">
				<div class="form-group">
					<label for="username">Kullanıcı Adı</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adı" />
				</div>
				<div class="form-group">
					<label for="password">Şifre</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Şifre" />
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="rememberme" name="rememberme" />
					<label class="form-check-label" for="rememberme">Beni Hatırla</label>
				</div>
				<div class="text-right">
					<a href="/index.php?path=register">Kayıt Ol</a>
				</div>
				<button type="submit" class="btn btn-primary">Giriş</button>
			</form>
		</div>
	</div>
</div>
<script src="/assets/vendor/jquery-validation-1.19.0/jquery.validate.min.js"></script>
<script src="/assets/vendor/jquery-validation-1.19.0/additional-methods.min.js"></script>
<script src="/assets/vendor/jquery-validation-1.19.0/localization/messages_tr.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		form_action.login();
	});
</script>