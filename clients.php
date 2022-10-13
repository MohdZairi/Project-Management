<?php
include_once 'config/Database.php';
include_once 'class/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn())
{
	header("Location: index.php");
}

include('inc/header.php');
?>


<title>webdamn.com : Demo Project Management Sytem with PHP and MySQL</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/client.js"></script>	
<script src="js/general.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" >  
<?php include('inc/container.php');?>
<div class="container">  
	<?php include('top_menus.php'); ?>	
	<div> 	
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" id="addClient" class="btn btn-info" title="Add Client"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="clientListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>					
					<th>Website</th>					
					<th>Industry</th>
					<th>Phone</th>										
					<th></th>
					<th></th>	
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="clientModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="clientForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Record</h4>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label for="name" class="control-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>			
						</div>
						<div class="form-group">
							<label for="website" class="control-label">Website</label>							
							<input type="text" class="form-control" id="website" name="website" placeholder="website">							
						</div>	   	
						<div class="form-group">
							<label for="industry" class="control-label">Industry</label>							
							<input type="text" class="form-control"  id="industry" name="industry" placeholder="industry" required>							
						</div>	
						<div class="form-group">
							<label for="description" class="control-label">Description</label>							
							<textarea class="form-control" rows="2" id="description" name="description"></textarea>							
						</div>	
						<div class="form-group">
							<label for="phone" class="control-label">Phone</label>							
							<input type="text" class="form-control" id="phone" name="phone" placeholder="phone">			
						</div>			
						<div class="form-group">
							<label for="address" class="control-label">Address</label>							
							<textarea class="form-control" rows="2" id="address" name="address"></textarea>							
						</div>
						<div class="form-group">
							<label for="country" class="control-label">Country</label>							
							<input type="text" class="form-control" id="country" name="country" placeholder="country">							
						</div>
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="id" id="id" />
    					<input type="hidden" name="action" id="action" value="" />
    					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
	
	<div id="clientDetails" class="modal fade">
    	<div class="modal-dialog">    		
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Client Details</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="name" class="control-label">Name:</label>
						<span id="cname"></span>	
					</div>
					<div class="form-group">
						<label for="website" class="control-label">Website:</label>				
						<span id="cwebsite"></span>							
					</div>	   	
					<div class="form-group">
						<label for="industry" class="control-label">Industry:</label>							
						<span id="cindustry"></span>								
					</div>	
					<div class="form-group">
						<label for="description" class="control-label">Description:</label>							
						<span id="cdescription"></span>								
					</div>	
					<div class="form-group">
						<label for="phone" class="control-label">Phone:</label>							
						<span id="cphone"></span>					
					</div>			
					<div class="form-group">
						<label for="address" class="control-label">Address:</label>							
						<span id="caddress"></span>							
					</div>
					<div class="form-group">
						<label for="country" class="control-label">Country</label>							
						<span id="ccountry"></span>								
					</div>
				</div>    				
			</div>    		
    	</div>
    </div>
	
</div>
 <?php include('inc/footer.php');?>
