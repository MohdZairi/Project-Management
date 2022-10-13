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
<link href="css/style.css" rel="stylesheet" type="text/css" >  
<?php include('inc/container.php');?>
<div class="container">  
	<h3><?php if($_SESSION["userid"]) { echo $_SESSION["name"]; } ?> | <a href="logout.php">Logout</a> </h3><br>
	<p>Welcome <?php echo $_SESSION["role"]; ?></p>	
	<ul class="nav nav-tabs">
		<?php if($_SESSION["role"] == 'manager') { ?>
			<li class="active"><a href="clients.php">Clients</a></li>
			<li><a href="projects.php">Projects</a></li> 
		<?php } ?>
		
		<?php if($_SESSION["role"] == 'employee') { ?>
			<li class="active"><a href="tasks.php">Tasks</a></li>		
		<?php } ?>
	
	</ul>
</div>
 <?php include('inc/footer.php');?>
