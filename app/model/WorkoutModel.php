<?php
class WorkoutModel extends Model{

	/* Create a new workout */
	public function addWorkout($name){
		$id = $_SESSION['id'];
		$stmt = $this->prepare("INSERT INTO workout (userId,name) VALUES (:userId,:name);");
		$stmt->bindParam(':userId',$id);
		$stmt->bindParam(':name',$name);
		$stmt->execute();		
		return $this->lastInsertId();
	}

	/* Read workout name and id for specific user */
	public function getWorkouts(){
		$id = $_SESSION['id'];
		$stmt = $this->prepare("SELECT workoutId,name FROM workout WHERE userId = :userId;");
		$stmt->bindParam(':userId',$id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	/* Read workout log data for specific user and specific excercise */
	public function getSpecificLogHistory($workoutId){
		$userId = $_SESSION['id'];
		$stmt = $this->prepare("SELECT 
			logId,reps,kilo,DATE_FORMAT(date,'%d.%m.%Y') as date FROM log
			WHERE log.userId = :userId AND log.workoutId = :workoutId;");
		$stmt->bindParam(':userId',$userId);
		$stmt->bindParam(':workoutId',$workoutId);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;

	}

	/* Create new log data for specific user and excercise.
	Then reads the same data if successfully added. */
	public function logWorkout($kilo,$reps,$workoutId){
		$userId = $_SESSION['id'];
		$stmt = $this->prepare("INSERT INTO log (workoutId,userId,reps,kilo,date) 
			VALUES (:workoutId,:userId,:reps,:kilo,CURDATE());");
		$stmt->bindParam(':workoutId',$workoutId);
		$stmt->bindParam(':userId',$userId);
		$stmt->bindParam(':reps',$reps);
		$stmt->bindParam(':kilo',$kilo);
		if($stmt->execute()){
			$lastInsertId = $this->lastInsertId();	
			$stmt = $this->prepare("SELECT 
				logId as id,w.name as name,reps,kilo,DATE_FORMAT(date,'%d.%m.%Y') as date 
				FROM log LEFT JOIN workout w on log.workoutId = w.workoutId 
				WHERE log.logId = :logId;");
			$stmt->bindParam(':logId',$lastInsertId);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		} else {
			return 0;
		}
	}

	/* Read workout log data for specific user */
	public function getLog(){
		$userId = $_SESSION['id'];
		$stmt = $this->prepare("SELECT 
			logId,w.name,reps,kilo,DATE_FORMAT(date,'%d.%m.%Y') as date 
			FROM log LEFT JOIN workout w on log.workoutId = w.workoutId 
			WHERE log.userId = :userId;");
		$stmt->bindParam(':userId',$userId);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	/* Delete workout log data for specific user and excercise */
	public function deleteLog($logId){
		$userId = $_SESSION['id'];
		$stmt = $this->prepare("DELETE FROM log WHERE logId = :logId AND userId = :userId;");
		$stmt->bindParam(':logId',$logId);
		$stmt->bindParam(':userId',$userId);
		return $stmt->execute();
	}

	/* Transaction delete log data tied to a specific excercise and user.
	Then deletes said excercise. Rollback if something fails */
	public function deleteWorkout($workoutId){
		$userId = $_SESSION['id'];
		$this->beginTransaction();
		$stmt = $this->prepare("DELETE FROM log WHERE workoutId = :workoutId AND userId = :userId;");
		$stmt->bindParam(':workoutId',$workoutId);
		$stmt->bindParam(':userId',$userId);
		$logRowsDeleted = $stmt->execute();
		$stmt = $this->prepare("DELETE FROM workout WHERE workoutId = :workoutId AND userId = :userId;");
		$stmt->bindParam(':workoutId',$workoutId);
		$stmt->bindParam(':userId',$userId);
		$workoutDeleted = $stmt->execute();
		if($logRowsDeleted && $workoutDeleted){
			$this->commit();
		} else {
			$this->rollback();
		}
		return ($logRowsDeleted && $workoutDeleted);
	}
}
?>
