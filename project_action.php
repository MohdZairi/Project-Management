<?php
include_once 'config/Database.php';
include_once 'class/Project.php';

$database = new Database();
$db = $database->getConnection();

$project = new Project($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listProjects') {
	$project->listProjects();
}


if(!empty($_POST['action']) && $_POST['action'] == 'addProject') {	
	$project->project_name = $_POST["project"];
    $project->client_id = $_POST["client"];
    $project->project_manager_id = $_POST["project_manager"];
	$project->active = $_POST["active"];
	$project->hourly_rate = $_POST["hourly_rate"];
	$project->budget = $_POST["budget"];
	$project->status_id = $_POST["project_status"];
	$project->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getProject') {
	$project->id = $_POST["id"];
	$project->getProject();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateProject') {
	$project->id = $_POST["id"];
	$project->project_name = $_POST["project"];
    $project->client_id = $_POST["client"];
    $project->project_manager_id = $_POST["project_manager"];
	$project->active = $_POST["active"];
	$project->hourly_rate = $_POST["hourly_rate"];
	$project->budget = $_POST["budget"];
	$project->status_id = $_POST["project_status"];
	$project->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteProject') {
	$project->id = $_POST["id"];
	$project->delete();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getProjectDetails') {
	$project->id = $_POST["id"];
	$project->getProjectDetails();
}

?>