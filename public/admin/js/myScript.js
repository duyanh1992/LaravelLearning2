$(document).ready(function() {
	$('#dataTables-example').DataTable({
			responsive: true
	});

	$('.alert').delay(3000).slideUp('slow');
});

// Deleting confirm message:
function delConfirm(){
	var conf = confirm('Are you sure ?');
	return conf;
}

// Deleting product image:
$('.imgDelBtn').click(function(){
	// Set url:
	var url = baseURL+'/admin/admin-content/product/delDetailImg/';
	// Set token:
	var token = $('#editPrdFrm input[name=_token]').val();

	// Set image id:
	var imgId = $(this).prev().attr('id');

	// Set image block id:
	var blockId = $(this).parent().attr('id');

	// Send ajax:
	$.ajax({
		url : url+imgId,
		type : 'GET',
		data : {'token': token, 'imgId': imgId},
		success : function(res){
			if(res == 'ok'){			// If everything is ok
				$('#'+blockId).remove();		// Remove that image block
			}
			else{
				alert('error');     // If not, show error
			}
		}
	});
});
