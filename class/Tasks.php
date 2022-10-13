<?php
class Tasks {	
   
	private $tasksTable = 'pm_tasks';
	private $projectsTable = 'pm_projects';
	private $milestoneTable = 'pm_milestones';
	private $userTable = 'pm_users';
	private $taskstatusTable = 'pm_task_status';
	private $hoursTable = 'pms_hours';


	private $conn;	
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function listTasks(){
		
		$sqlQuery = "SELECT t.id, t.task_name, t.instruction, t.total_hours, s.status, p.project_name, m.name as milestone, u.first_name, u.last_name 
			FROM ".$this->tasksTable." t 
			LEFT JOIN ".$this->projectsTable." p ON p.id = t.project_id
			LEFT JOIN ".$this->milestoneTable." m ON m.id = t.milestone_id
			LEFT JOIN ".$this->userTable." u ON u.id = t.employee_id
			LEFT JOIN ".$this->taskstatusTable." s ON s.id = t.status_id 
			WHERE t.employee_id = '".$_SESSION["userid"]."'";
			
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= ' AND (t.task_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.status_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR t.total_hours LIKE "%'.$_POST["search"]["value"].'%") ';								
		}
		
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY t.id DESC ';
		}
		
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();	
		
		$stmtTotal = $this->conn->prepare("SELECT * FROM ".$this->tasksTable." WHERE employee_id = '".$_SESSION["userid"]."'");
		$stmtTotal->execute();
		$allResult = $stmtTotal->get_result();
		$allRecords = $allResult->num_rows;
		
		$displayRecords = $result->num_rows;
		$records = array();		
		while ($task = $result->fetch_assoc()) { 				
			$rows = array();		
			$rows[] = '<span id="'.$task['id'].'">&nbsp;&nbsp;&nbsp;</span>';
			$rows[] = $task['id'];
			$rows[] = ucfirst($task['project_name']);
			$rows[] = ucfirst($task['task_name']);
			$rows[] = $task['milestone'];		
			$rows[] = $task['total_hours'];
			$rows[] = $task['status'];
			$rows[] = $task['instruction'];						
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

	public function getHours(){
		if($this->id) {
			$sqlQuery = "SELECT *
			FROM ".$this->hoursTable."   
			WHERE task_id = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("i", $this->id);	
			$stmt->execute();
			$result = $stmt->get_result();
			$records = array();		
			while ($hours = $result->fetch_assoc()) {
				$records[] = $hours;
			}
			echo json_encode($records);
		}
	}

	public function insertHours(){
		
		if($this->task_id && $this->time && $this->work && $this->date) {

			$stmt = $this->conn->prepare("
			INSERT INTO ".$this->hoursTable."(`date`, `time`, `work_completed`, `task_id`, `employee_id`)
			VALUES(?,?,?,?,?)");
		
			$this->date = htmlspecialchars(strip_tags($this->date));
			$this->time = htmlspecialchars(strip_tags($this->time));
			$this->work = htmlspecialchars(strip_tags($this->work));
			$this->task_id = htmlspecialchars(strip_tags($this->task_id));						
			
			$stmt->bind_param("sssii", $this->date, $this->time, $this->work, $this->task_id, $_SESSION["userid"]);
			
			if($stmt->execute()){
				return true;
			}		
		}
	}	
	
}
?>