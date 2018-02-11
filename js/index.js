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

function openPublishModal(){
	if(login){
		$('#publishModal').modal();
	}else{
		window.location.href = '/login.php';
	}
}

function doPublish(){
	
}