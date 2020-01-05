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
	public function logWorkout(){

	}
}
?>
