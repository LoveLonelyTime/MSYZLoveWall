$(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $( "#tabs" ).tabs();
});

function showChangeHeaderModal(){
	$('#changeHeaderModal').modal();
}

function showChangeSexModal(){
	$('#changeSexModal').modal();
}

function showChangeValueModal(title,func){
	$('#changeValueModalTitle').text('更改' + title);
	$('#valueInput').attr('placeholder','请输入新的' + title);
	$('#valueButton').attr('onclick',func);
	$('#changeValueModal').modal();
}

function showChangeGradeModal(){
	$('#changeGradeModal').modal();
}

function showChangeClassModal(){
	$('#changeClassModal').modal();
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
	}
});

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

function doChangeSex(){
	changeInformation('sex',$('#sexSelect').val());
}

function doChangeSignature(){
	changeInformation('signature',$('#valueInput').val());
}

function doChangeQQ(){
	changeInformation('QQ',$('#valueInput').val());
}

function doChangeRealName(){
	changeInformation('real_name',$('#valueInput').val());
}

function doChangeGrade(){
	changeInformation('grade',$('#gradeSelect').val());
}

function doChangeClass(){
	changeInformation('class',$('#classSelect').val());
}