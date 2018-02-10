var usernameVerification = false,passwordVerification = false;

function showInvalid(prefix,msg){
	$('#' + prefix + 'Input').addClass('is-invalid');
	$('#errorText').text(msg);
}

function showValid(prefix){
	$('#' + prefix + 'Input').removeClass('is-invalid');
	$('#' + prefix + 'Input').addClass('is-valid');
	$('#errorText').text('');
}

function validateUsername(){
	var inputValue = $('#usernameInput').val();
	if(inputValue.length > 0 && inputValue.length < 50){
		if(/^[\u4E00-\u9FA5A-Za-z0-9_]+$/.test(inputValue)){
			showValid('username');
			usernameVerification = true;
		}else{
			showInvalid('username','用户名只能由中文、英文、数字和下划线组成');
			usernameVerification = false;
		}
	}else{
		showInvalid('username','用户名的长度应在0到50位之间');
		usernameVerification = false;
	}
}

function validatePassword(){
	var inputValue = $('#passwordInput').val();
	if(inputValue.length > 6 && inputValue.length < 50){
		if(/^\w+$/.test(inputValue)){
			showValid('password');
			passwordVerification = true;
		}else{
			showInvalid('password','密码只能由数字、英文字母、下划线组成');
			passwordVerification = false;
		}
	}else{
		showInvalid('password','密码的长度应在6到50位之间');
		passwordVerification = false;
	}
}

function doLogin(){
	validateUsername();
	validatePassword();
	if(usernameVerification && passwordVerification){
		$.ajax({
			url:'/handler/loginHandler.php',
			type:'POST',
			dataType:'json',
			data:{
				username:$('#usernameInput').val(),
				password:$('#passwordInput').val()
			},
			success:function(json){
				if(json.result === "success"){
					window.location.href = '/index.php';
				}else if(json.result === "input_error"){
					showInvalid(json.field,json.description);
				}else if(json.result === "error"){
					$('#errorText').text('登录失败，' + json.description);
				}
			},
			error:function(){
				$('#errorText').text('登录失败，网络繁忙，请稍后重试');
			}
		});
	}
}

$(function(){
	$('#usernameInput').blur(function(){
		validateUsername();
	});
	$('#passwordInput').blur(function(){
		validatePassword();
	});
});