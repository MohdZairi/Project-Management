$(document).ready(function(){	

	var clientRecords = $('#clientListing').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,		
		"bFilter": false,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"client_action.php",
			type:"POST",
			data:{action:'listClients'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 5, 6, 7],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	
	
	$('#addClient').click(function(){
		$('#clientModal').modal({
			backdrop: 'static',
			keyboard: false
		});
		$('#clientForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Client");
		$('#action').val('addClient');
		$('#save').val('Save');
	});		
	
	$("#clientListing").on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'getClient';
		$.ajax({
			url:'client_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){				
				$("#clientModal").on("shown.bs.modal", function () { 
					$('#id').val(data.id);
					$('#name').val(data.name);
					$('#website').val(data.website);
					$('#industry').val(data.industry);
					$('#description').val(data.description);				
					$('#phone').val(data.phone);
					$('#address').val(data.address);
					$('#country').val(data.country);						
					$('.modal-title').html("<i class='fa fa-plus'></i> Edit Client");
					$('#action').val('updateClient');
					$('#save').val('Save');
				}).modal({
					backdrop: 'static',
					keyboard: false
				});			
			}
		});
	});
	
	$("#clientModal").on('submit','#clientForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"client_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#clientForm')[0].reset();
				$('#clientModal').modal('hide');				
				$('#save').attr('disabled', false);
				clientRecords.ajax.reload();
			}
		})
	});	
	
	$("#clientListing").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var action = "deleteClient";
		if(confirm("Are you sure you want to delete this client?")) {
			$.ajax({
				url:"client_action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data) {					
					clientRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
	
	$("#clientListing").on('click', '.view', function(){
		var id = $(this).attr("id");
		var action = 'getClient';
		$.ajax({
			url:'client_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){				
				$("#clientDetails").on("shown.bs.modal", function () { 					
					$('#cname').html(data.name);
					$('#cwebsite').html(data.website);
					$('#cindustry').html(data.industry);
					$('#cdescription').html(data.description);				
					$('#cphone').html(data.phone);
					$('#caddress').html(data.address);
					$('#ccountry').html(data.country);					
				}).modal();			
			}
		});
	});
	
	});