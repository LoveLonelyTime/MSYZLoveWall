$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

function showChangeHeaderModal(){
	$('#changeHeaderModal').modal();
}

var uploader = simple.uploader({
	url: '/handler/imageUploadHandler.php',
	params:null,
	fileKey:'file'
});

$('#upload-file').on('change', function(e) {
	uploader.upload(this.files);
});

uploader.on('uploadsuccess',function(e, file, result){
	if(result.success == "true"){
		$('#showHeaderImg').attr('src',result.file_path);
		$('#showHeaderImg').css('display','inline');
	}else{
		$('.alert').css('display','block');
	}
});

uploader.on('uploaderror',function(e, file, xhr, status){
	$('.alert').css('display','block');
});

function closeAlert(){
	$('.alert').css('display','none');
}

function changeInformation(category,newInformation){
	$.ajax({
		url:'/handler/changeInformationHandler.php',
		type:'POST',
		dataType:'json',
		data:{
			category:category,
			newInformation:newInformation
		},
		complete:function(){
			location.reload();
		}
	});
}

function doChangeHeader(){
	if($('#showHeaderImg').css('display') == 'inline'){
		changeInformation('header',$('#showHeaderImg').attr('src'));
	}
}