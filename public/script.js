getWorkoutSelectId();
function getWorkoutSelectId(){
	let select = document.getElementById('workoutSelect');
	if(select){
		select.addEventListener("change",function(){
			let selected = select.options[select.selectedIndex];
			let id = selected.getAttribute('data');
			let idInput = document.getElementById('workoutId');
			idInput.setAttribute('value',id);
		});
	}
}
