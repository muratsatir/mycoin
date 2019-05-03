var form_action={
	login:function(){

	},
	register:function(){
		$("#register_form").validate({
			submitHandler: function(form) {
			  var element = $("#guest_next_button");
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
							  $(element).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
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
