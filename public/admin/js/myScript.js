$(document).ready(function() {
	$('#dataTables-example').DataTable({
			responsive: true
	});
	
	$('#addingMessage').delay(3000).slideUp('slow');
	
});

function delConfirm(){
	var conf = confirm('Are you sure ?');
	return conf;
}

$('.imgDelBtn').click(function(){
	var url = 'http://localhost/LaravelLearning2/public/admin/admin-content/product/delDetailImg/'; 
	var token = $('#editPrdFrm input[name=_token]').val();
	var imgId = $(this).prev().attr('id');
	var urlImg = $(this).prev().attr('src');
	//var urlImg = 'image/';
	var blockId = $('.detailImgBlock').attr('id');
	
	$.ajax({
		url : url+imgId,
		type : 'GET',
		data : {'token': token, 'imgId': imgId, 'urlImg': urlImg},
		success : function(res){
			if(res == 'ok'){
				$('#'+blockId).remove();
			}
			else{
				alert('error');
			}
			console.log(res);
		}
	});
});