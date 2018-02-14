function openPublishModal(){
	if(login){
		$('#publishModal').modal();
	}else{
		window.location.href = '/login.php';
	}
}

function doPublish(){
	if(login){
		$.ajax({
			url:'/handler/publishHandler.php',
			type:'POST',
			dataType:'json',
			data:{
				anonymous:$('#anonymousCheck').prop('checked')?'true':'false',
				html:editor.getValue()
			},
			complete:function(){
				location.reload();
			}
		});
	}else{
		window.location.href = '/login.php';
	}
}

$(function(){
	//Init Simditor
	var editor = new Simditor({
		textarea: $('#editor'),
		defaultImage: '/img/default_image.png',
		upload:{
			url:'/handler/imageUploadHandler.php',
			params:null,
			fileKey:'file',
			connectionCount:3,
			leaveConfirm:'图片上传中，你确定要离开吗？'
		}
	});
	//Init ObjectInput
	$('#objectInput').autocomplete({
		minLength:2,
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
		return $('<li>').append('<div class="row"><div class="col-auto"><img src="'+ item.header +'" alt="Header" width="50" height="50" class="img-thumbnail"/></div><div class="col"><h5>'+ item.username +'</h5><h6 class="text-muted">'+ item.signature +'</h6></div></div>').appendTo(ul);
	};
});