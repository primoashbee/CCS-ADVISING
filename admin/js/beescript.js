$('#btnAddCsvProspectus').click(function(){
	var file = $('#opdUploadProspectus').val();
	
				$.ajax({
					url:'uploadProspectus.php',
					data:{file:file},
					dataType:'JSON',
					type:'POST',
					success:function(data){
					console.log(data.OK	)
					}
					
				});
				})
