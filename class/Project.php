<?php
class Project {	
   
	private $projectTable = 'pm_projects';
	private $usersTable = 'pm_users';
	private $statusTable = 'pm_status';
	private $clientTable = 'pm_clients';
	private $conn;	
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listProjects(){
		
		$sqlQuery = "SELECT p.id, p.project_name, p.hourly_rate, p.budget, u.first_name, u.last_name, s.status, c.name as client
			FROM ".$this->projectTable." p 
			LEFT JOIN ".$this->usersTable." u ON u.id = p.project_manager_id
			LEFT JOIN ".$this->statusTable." s ON s.id = p.status_id
			LEFT JOIN ".$this->clientTable." c ON c.id = p.client_id ";
			
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' WHERE (p.project_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.hourly_rate LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR p.budget LIKE "%'.$_POST["search"]["value"].'%") ';								
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY p.id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->projectTable);
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($project = $result->fetch_assoc()) { 				
			$rows = array();			
			$rows[] = $project['id'];
			$rows[] = ucfirst($project['client']);
			$rows[] = ucfirst($project['project_name']);
			$rows[] = $project['status'];		
			$rows[] = ucfirst($project['first_name'])." ".ucfirst($project['last_name']);
			$rows[] = "$".$project['hourly_rate'];
			$rows[] = "$".$project['budget'];			
			$rows[] = '<button type="button" name="view" id="'.$project["id"].'" class="btn btn-info btn-xs view"><span class="glyphicon glyphicon-file" title="View"></span></button>';			
			$rows[] = '<button type="button" name="update" id="'.$project["id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-edit" title="Edit"></span></button>';
			$rows[] = '<button type="button" name="delete" id="'.$project["id"].'" class="btn btn-danger btn-xs delete" ><span class="glyphicon glyphicon-remove" title="Delete"></span></button>';
			$records[] = $rows;
		}
		
		$output = array(
			"draw"	=>	intval($_POST["draw"]),			
			"iTotalRecords"	=> 	$displayRecords,
			"iTotalDisplayRecords"	=>  $allRecords,
			"data"	=> 	$records
		);
		
		echo json_encode($output);
	}
	
	function managerList(){		
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->usersTable." WHERE role='manager'");				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

	function statusList(){		
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->statusTable);				
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	
	public function insert(){
		
		if($this->project_name) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->projectTable."(`project_name`, `client_id`, `project_manager_id`, `active`, `hourly_rate`,`budget`,`status_id`)
			VALUES(?,?,?,?,?,?,?)");
		
			$this->project_name = htmlspecialchars(strip_tags($this->project_name));
			$this->client_id = htmlspecialchars(strip_tags($this->client_id));
			$this->project_manager_id = htmlspecialchars(strip_tags($this->project_manager_id));
			$this->active = htmlspecialchars(strip_tags($this->active));
			$this->hourly_rate = htmlspecialchars(strip_tags($this->hourly_rate));
			$this->budget = htmlspecialchars(strip_tags($this->budget));	
			$this->status_id = htmlspecialchars(strip_tags($this->status_id));				
			
			$stmt->bind_param("siiissi", $this->project_name, $this->client_id, $this->project_manager_id, $this->active, $this->hourly_rate, $this->budget, $this->status_id);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}
	
	public function getProject(){
		if($this->id) {
			$sqlQuery = "SELECT *
			FROM ".$this->projectTable."   
			WHERE id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}

	public function update(){
		
		if($this->id) {					
			$stmt = $this->conn->prepare("
			UPDATE ".$this->projectTable." 
			SET project_name= ?, client_id = ?, project_manager_id = ?, active = ?, hourly_rate = ?, budget = ?, status_id = ?
			WHERE id = ?");
	 
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->project_name = htmlspecialchars(strip_tags($this->project_name));
			$this->client_id = htmlspecialchars(strip_tags($this->client_id));
			$this->project_manager_id = htmlspecialchars(strip_tags($this->project_manager_id));
			$this->active = htmlspecialchars(strip_tags($this->active));
			$this->hourly_rate = htmlspecialchars(strip_tags($this->hourly_rate));
			$this->budget = htmlspecialchars(strip_tags($this->budget));	
			$this->status_id = htmlspecialchars(strip_tags($this->status_id));			
			
			$stmt->bind_param("siiissii", $this->project_name, $this->client_id, $this->project_manager_id, $this->active, $this->hourly_rate, $this->budget, $this->status_id, $this->id);
			
			if($stmt->execute()){
				return true;
			}
			
		}	
	}
	
	public function delete(){
		if($this->id) {			

			$stmt = $this->conn->prepare("
				DELETE FROM ".$this->projectTable." 
				WHERE id = ?");

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt->bind_param("i", $this->id);

			if($stmt->execute()){
				return true;
			}
		}
	} 

	public function getProjectDetails(){
		if($this->id) {
			$sqlQuery = "SELECT p.id, p.project_name, p.active, p.hourly_rate, p.budget, u.first_name, u.last_name, s.status, c.name as client
			FROM ".$this->projectTable." p 
			LEFT JOIN ".$this->usersTable." u ON u.id = p.project_manager_id
			LEFT JOIN ".$this->statusTable." s ON s.id = p.status_id
			LEFT JOIN ".$this->clientTable." c ON c.id = p.client_id 
			WHERE p.id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$record = $result->fetch_assoc();
			echo json_encode($record);
		}
	}
}
?>