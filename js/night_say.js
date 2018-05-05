function doComment(id){
	if(login){
		var comment = $('#' + id + "CommentInput").val();
		if(comment.length != 0){
			$.ajax({
				url:'/handler/nightSayCommentHandler.php',
				type:'POST',
				dataType:'json',
				data:{
					content:comment,
					night_say_id:id
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