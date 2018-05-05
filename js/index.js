var editor = new Simditor({
	textarea: $('#editor'),
	defaultImage: '/img/default_image.png',
	toolbar:[
		'title',
		'bold',
		'italic',
		'underline',
		'strikethrough',
		'fontScale',
		'color',
		'ol',
		'ul',
		'blockquote',
		'code',
		'table',
		'link',
		'image',
		'hr',
		'indent',
		'outdent',
		'alignment'
	],
	toolbarFloat:false,
	upload:{
		url:'/handler/imageUploadHandler.php',
		params:null,
		fileKey:'file',
		connectionCount:3,
		leaveConfirm:'图片上传中，你确定要离开吗？'
	}
});

function doPublish(){
	if(login){
		if($('#objectInput').val().length !=0 && editor.getValue().length != 0){
			$.ajax({
				url:'/handler/publishHandler.php',
				type:'POST',
				dataType:'json',
				data:{
					anonymous:$('#anonymousCheck').prop('checked')?'true':'false',
					object:$('#objectInput').val(),
					html:editor.getValue()
				},
				success:function(date){
					if(date.result == 'success'){
						location.reload();
					}else{
						$('.modal-body').text('网络出错了，请稍后重试');
						$('#resultModal').modal();
					}
				},
				error:function(){
					$('.modal-body').text('网络出错了，请稍后重试');
					$('#resultModal').modal();
				}
			});
		}else{
			$('.modal-body').text('表白对象或内容为空');
			$('#resultModal').modal();
		}
	}else{
		window.location.href = '/login.php';
	}
}

function doComment(id){
	if(login){
		var comment = $('#' + id + "CommentInput").val();
		if(comment.length != 0){
			$.ajax({
				url:'/handler/commentHandler.php',
				type:'POST',
				dataType:'json',
				data:{
					content:comment,
					love_note_id:id
				},
				success:function(date){
					if(date.result == 'success'){
						location.reload();
					}else{
						$('.modal-body').text('网络出错了，请稍后重试');
						$('#resultModal').modal();
					}
				},
				error:function(){
					$('.modal-body').text('网络出错了，请稍后重试');
					$('#resultModal').modal();
				}
			});
		}
	}else{
		window.location.href = '/login.php';
	}
}

$(function(){
	//Init ObjectInput
	$('#objectInput').autocomplete({
		minLength:1,
		source:function(request,response){
			 $.ajax({
				url:'/handler/searchUserHandler.php',
				type:'GET',
				dataType:'json',
				data:{
					term:request.term
				},
				success:function(data){
					response(data);
				}
			});
		},
		select:function(event,ui){
			$('#objectInput').val('@' + ui.item.username);
			return false;
		}
	}).autocomplete('instance')._renderItem = function(ul, item){
		return $('<li>').append('<div class="row"><div class="col-auto"><img src="'+ item.header +'" alt="Header" width="50" height="50" class="img-thumbnail"/></div><div class="col"><h5>'+ item.username +'</h5><h6 class="text-muted">个性签名：'+ item.signature +'</h6><h6 class="text-muted">真实姓名：'+ item.real_name +'</h6></div></div>').appendTo(ul);
	};
});