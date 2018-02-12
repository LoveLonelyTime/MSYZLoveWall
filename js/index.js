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
	if(login){
		$.ajax({
			url:'/handler/publishHandler.php',
			type:'POST',
			dataType:'json',
			data:{
				anonymous:$('#anonymousCheck').prop('checked')?'true':'false',
				html:editor.getValue()
			},
			success:function(json){
				if(json.result === 'success'){
					location.reload();
				}else if(json.result === 'error'){
					$('.alert').css('display','block');
				}
			},
			error:function(){
				$('.alert').css('display','block');
			}
		});
	}else{
		window.location.href = '/login.php';
	}
}

function closeAlert(){
	$('.alert').css('display','none');
}

  $(function () {
            /*** 1.基本示例 ***/
            var provinces = ["广东省", "海南省", "山西省", "山东省","湖北省", "湖南省", "陕西省", "上海市", "北京市", "广西省"];

            var substringMatcher = function (strs) {
                return function findMatches(q, cb) {
                    var matches, substrRegex;
                    matches = [];//定义字符串数组
                    substrRegex = new RegExp(q, 'i');
                    //用正则表达式来确定哪些字符串包含子串的'q'
                    $.each(strs, function (i, str) {
                    //遍历字符串池中的任何字符串
                        if (substrRegex.test(str)) {
                            matches.push({ value: str });
                        }
                    //包含子串的'q',将它添加到'match'
                    });
                    cb(matches);
                };
            };

            $('#basic-example .typeahead').typeahead({
                highlight: true,
                minLength: 1
            },
            {
                name: 'provinces',
                displayKey: 'value',
                source: substringMatcher(provinces)
            });

        });