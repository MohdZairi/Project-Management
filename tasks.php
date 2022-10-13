<?php
include_once 'config/Database.php';
include_once 'class/User.php';


$database = new Database();
$db = $database->getConnection();

$user=  new User($db);

if(!$user->loggedIn())
{
    header("Location: index.php");
}
include('inc/header.php');
?>
<?php
include_once 'config/Database.php';
include_once 'class/User.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('inc/header.php');
?>
<title>webdamn.com : Demo Project Management Sytem with PHP and MySQL</title>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/tasks.js"></script>	
<script src="js/general.js"></script>
<style>
td.details-control {
    background: url('images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('images/details_close.png') no-repeat center center;
}
</style>
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
					<button type="button" id="addProject" class="btn btn-info" title="Add project"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
			</div>
		</div>
		<table id="taskListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Id</th>
					<th>Project Name</th>					
					<th>Task Name</th>					
					<th>Milestone</th>
					<th>Total Hours</th>	
					<th>Status</th>										
					<th>Instructions</th>									
				</tr>
			</thead>
		</table>
	</div>
	
	
	<div id="hoursModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="hoursForm">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Hours</h4>
    				</div>
    				<div class="modal-body">						
						<div class="form-group">
							<label for="phone" class="control-label">Date</label>							
							<input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD">			
						</div>
						<div class="form-group">
							<label for="phone" class="control-label">Time</label>							
							<input type="text" class="form-control" id="time" name="time" placeholder="Time...">			
						</div>			
						<div class="form-group">
							<label for="address" class="control-label">Work Completed</label>							
							<textarea class="form-control" rows="2" id="work" name="work"></textarea>							
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
	
	
</div>
 <?php include('inc/footer.php');?>
