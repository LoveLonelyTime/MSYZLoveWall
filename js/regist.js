var usernameVerification = false,QQVerification = false,passwordVerification = false,confirmPasswordVerification = false;

function showInvalid(prefix,msg){
	$("#" + prefix + 'Input').addClass('is-invalid');
	$("#" + prefix + 'Help').addClass('invalid-feedback');
	$("#" + prefix + 'Help').removeClass('text-muted');
	$("#" + prefix + 'Help').text(msg);
}

function showValid(prefix,msg){
	$("#" + prefix + 'Input').removeClass('is-invalid');
	$("#" + prefix + 'Input').addClass('is-valid');
	$("#" + prefix + 'Help').removeClass('invalid-feedback');
	$("#" + prefix + 'Help').addClass('valid-feedback');
	$("#" + prefix + 'Help').text(msg);
}

function showModal(title,content){
	$('#resultModalTitle').text(title);
	$('#resultModalContent').text(content);
	$('#resultModal').modal();
}

function validateUsername(){
	var inputValue = $('#usernameInput').val();
	if(inputValue.length > 0 && inputValue.length < 50){
		if(/^[\u4E00-\u9FA5A-Za-z0-9_]+$/.test(inputValue)){
			//TODO Verifying the uniqueness of the username
			showValid('username','符合要求');
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

function validateQQ(){
	var inputValue = $('#QQInput').val();
	if(/^[1-9]\d{4,10}$/.test(inputValue)){
		showValid('QQ','符合要求');
		QQVerification = true;
	}else{
		showInvalid('QQ','你输入的QQ不合格格式');
		QQVerification = false;
	}
}

function validatePassword(){
	var inputValue = $('#passwordInput').val();
	if(inputValue.length > 6 && inputValue.length < 50){
		if(/^\w+$/.test(inputValue)){
			showValid('password','符合要求');
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

function validateConfirmPassword(){
	var inputValue = $('#confirmPasswordInput').val();
	if(inputValue.length > 6 && inputValue.length < 50){
		if(/^\w+$/.test(inputValue)){
			if(inputValue === $('#passwordInput').val()){
				showValid('confirmPassword','符合要求');
				confirmPasswordVerification = true;
			}else{
				showInvalid('confirmPassword','你输入的两次密码不一样');
				confirmPasswordVerification = false;
			}
		}else{
			showInvalid('confirmPassword','密码只能由数字、英文字母、下划线组成');
			confirmPasswordVerification = false;
		}
	}else{
		showInvalid('confirmPassword','密码的长度应在6到50位之间');
		confirmPasswordVerification = false;
	}
}

function doRegist(){
	validateUsername();
	validateQQ();
	validatePassword();
	validateConfirmPassword();
	if(usernameVerification && QQVerification && passwordVerification && confirmPasswordVerification){
		$.ajax({
			url:'handler/registHandler.php',
			type:'POST',
			dataType:'json',
			data:{
				username:$('#usernameInput').val(),
				password:$('#passwordInput').val(),
				QQ:$('#QQInput').val()
			},
			success:function(json){
				if(json.result === "success"){
					showModal('注册成功','马上带你进入登录页面');
					window.location.href = 'login.php';
				}else if(json.result === "input_error"){
					showInvalid(json.field,json.description);
				}else if(json.result === "error"){
					showModal('注册失败','注册失败，' + json.description);
				}
			},
			error:function(){
				showModal('注册失败','注册失败，网络繁忙，请稍后重试');
			}
		});
	}
}

$(function(){
	$('#usernameInput').blur(function(){
		validateUsername();
	});
	$('#QQInput').blur(function(){
		validateQQ();
	});
	$('#passwordInput').blur(function(){
		validatePassword();
	});
	$('#confirmPasswordInput').blur(function(){
		validateConfirmPassword();
	});
});