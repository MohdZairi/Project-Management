<?php
include_once 'config/Database.php';
include_once 'class/Clients.php';

$database = new Database();
$db = $database->getConnection();

$client = new Clients($db);

if(!empty($_POST['action']) && $_POST['action'] == 'listClients') {
	$client->listClients();
}

if(!empty($_POST['action']) && $_POST['action'] == 'addClient') {	
	$client->name = $_POST["name"];
    $client->website = $_POST["website"];
    $client->industry = $_POST["industry"];
	$client->description = $_POST["description"];
	$client->phone = $_POST["phone"];
	$client->address = $_POST["address"];
	$client->country = $_POST["country"];
	$client->insert();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getClient') {
	$client->id = $_POST["id"];
	$client->getClient();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateClient') {
	$client->id = $_POST["id"];
	$client->name = $_POST["name"];
    $client->website = $_POST["website"];
    $client->industry = $_POST["industry"];
	$client->description = $_POST["description"];
	$client->phone = $_POST["phone"];
	$client->address = $_POST["address"];
	$client->country = $_POST["country"];
	$client->update();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteClient') {
	$client->id = $_POST["id"];
	$client->delete();
}

?>