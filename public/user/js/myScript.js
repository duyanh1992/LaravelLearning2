$(function(){
	var baseURL = $('input[name=project_path]').val();
	//alert(baseURL);
	//Update shopping cart:
	$('input[name=quantity]').keyup(function(){
		//Get new quantity value;
		var newQty = parseInt($(this).val());

		//Get rowId:
		var rowId = $(this).next().val();

		//Get user id:
		var userId = $('input[name=userId]').val();

		//Get token form:
		var tokenForm = $('input[name=_token]').val();

		// Send ajax:
		$.ajax({
			url: baseURL+'/homesite/shoppingCart/getEditCart',
			data: {'qty':newQty, 'rowId':rowId, 'tokenForm':tokenForm},
			success: function(res){
				console.log(res);
				if(res == 'ok'){
					window.location = baseURL+"/homesite/shoppingCart/getCartInfo/"+userId;
				}
			}
		});
	});

	//Use select box to order product:
	// $('select[name="sltOrder"]').change(function(){
	// 	//console.log($(this).val());
	// 	var url = 'http://localhost/LaravelLearning2/public/homesite/filterPrd';
	// 	var token = $('#filterPrd input[name=_token]').val();
	// 	var cate_id = $('#filterPrd input[name=cate_id]').val();
	// 	var str_key = $(this).val();
	// 	//console.log($(this).val());
	// 	$.ajax({
	// 		url : url,
	// 		type : 'POST',
	// 		data : {'_token': token, 'str_key':str_key, 'cate_id':cate_id},
	// 		success: function(res){
	// 			var deletePostUri = "{{ route('getAllPrdByCate',$post_id)}}";
	// 		}
	// 	});
	// })
});
