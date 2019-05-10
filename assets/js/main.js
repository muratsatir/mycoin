var form_action={
	login:function(){
		$("#login_form").validate({
			submitHandler: function(form) {
			  $.ajax({
					url: 'index.php?path=login',
					dataType: 'json',
					data : $('#login_form').serialize(),
					type:'post',
					success: function(json) {
						 if(json['success']==false){
							$(form).before('<div class="alert alert-danger">' + json['message'] + '</div>');
						 }
						 if(json['redirect']){
							window.location.href=json['redirect'];
						 }
					},
					error: function(xhr, ajaxOptions, thrownError) {
						 alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
			  });
			},
			rules: {
				username: {
					required: true
			  },
			  	password:{
					required: true
			  }
			 }
		 });
	},
	register:function(){
		$("#register_form").validate({
			submitHandler: function(form) {
			  var element = $("#username");
			  $.ajax({
					url: 'index.php?path=register',
					dataType: 'json',
					data : $('#register_form').serialize(),
					type:'post',
					success: function(json) {
						 if(json['redirect']){
							window.location.href=json['redirect'];
						 }
						 if(json['error']){
							  $(element).parent().before('<div class="alert alert-danger">' + json['error'] + '</div>');
							  setTimeout(function(){
								  $('.alert').fadeOut();
							  },2500);
						 }
					},
					error: function(xhr, ajaxOptions, thrownError) {
						 alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
			  });
			},
			rules: {
				username: {
					required: true
			  },
			  	password:{
					required: true
			  },
			  	confirm:{
					required: true
			  },
			 }
		 });
	},
	profile_update:function(){
		$("#profile_form").validate({
		submitHandler: function(form) {
		  var element = $("#guest_next_button");
		  $.ajax({
				url: 'index.php?path=profile',
				dataType: 'json',
				data : $('#profile_form').serialize(),
				type:'post',
				success: function(json) {
					 if(json.success==true){
						$(form).before('<div class="alert alert-success">' + json['message'] + '</div>');
					 }
				},
				error: function(xhr, ajaxOptions, thrownError) {
					 alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
		  });
		},
		rules: {
			username: {
				required: true
		  }
		 }
	 });
	},
	forgot:function(){

	}
}
