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
	if(editor.getValue().length != 0){
		$.ajax({
			url:'/handler/publishNightSayHandler.php',
			type:'POST',
			dataType:'json',
			data:{
				content:editor.getValue()
			},
			complete:function(){
				location.reload();
			}
		});
	}
}