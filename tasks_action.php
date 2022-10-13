<?php
include_once 'config/Database.php';
include_once 'class/Tasks.php';

$database = new Database();
$db = $database->getConnection();

$task = new Tasks($db);



if(!empty($_POST['action']) && $_POST['action'] == 'listTasks') {
	$task->listTasks();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getHours') {
	$task->id = $_POST["id"];
	$task->getHours();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addHours') {	
	$task->date = $_POST["date"];
    $task->time = $_POST["time"];
    $task->work = $_POST["work"];
	$task->task_id = $_POST["id"];	
	$task->insertHours();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteHours') {
	$task->id = $_POST["id"];
	$task->deleteHours();
}
?>