$(document).ready(function(){ 
	var flag = false;

	$('#pre').click(function(){ 
		var data = $('#form').serialize();
		
		if (flag) {
			if (confirm("Выйти из preview?")) {
				$.ajax({
					url: '/preview',
					type: 'POST',
					data: data,
					success: function(data){
						$('table#preview_table').remove();
						flag = false;
						$(':input', '#form').not(':submit').val('');
					}
				});
			return false;
			} else {
				 return false;
			}
		} else {
			$.ajax({
				url: '/preview',
				type: 'POST',
				data: data,
				success: function(data){
					$('#form').before(data);
					flag = true;
				}
			});
		return false;
		}
	});

});