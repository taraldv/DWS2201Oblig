<?php
class Workout_model extends Model{
	public function addWorkout($name){
		$id = $_SESSION['id'];
		$stmt = $this->prepare("INSERT INTO workout (userId,name) VALUES (:userId,:name);");
		$stmt->bindParam(':userId',$id);
		$stmt->bindParam(':name',$name);
		$stmt->execute();		
	}
	public function getWorkouts(){
		$id = $_SESSION['id'];
		$stmt = $this->prepare("SELECT workoutId,name FROM workout WHERE userId = :userId;");
		$stmt->bindParam(':userId',$id);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	public function logWorkout($dataArray){
		$kilo = $dataArray['kilo'];
		$reps = $dataArray['reps'];
		$workoutId = $dataArray['workoutId'];
		$userId = $_SESSION['id'];
		$stmt = $this->prepare("INSERT INTO log (workoutId,userId,reps,kilo,date) 
			VALUES (:workoutId,:userId,:reps,:kilo,CURDATE());");
		$stmt->bindParam(':workoutId',$workoutId);
		$stmt->bindParam(':userId',$userId);
		$stmt->bindParam(':reps',$reps);
		$stmt->bindParam(':kilo',$kilo);
		$stmt->execute();
	}
	public function getLog(){
		$userId = $_SESSION['id'];
		$stmt = $this->prepare("SELECT 
			logId,w.name,reps,kilo,DATE_FORMAT(date,'%d.%m.%y') as date 
			FROM log LEFT JOIN workout w on log.workoutId = w.workoutId 
			WHERE log.userId = :userId;");
		$stmt->bindParam(':userId',$userId);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	
	}
}
?>
