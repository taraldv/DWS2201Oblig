/* Enables javascript for workout/index page */
function applyIndexEventListener(){
	let select = document.getElementById('workoutSelect');
	select.addEventListener('change',updateIndexTableFromSelect);
	/* Run function once at the start to build initial table */
	updateIndexTableFromSelect();
}

/*Delete button string, used in multiple functions*/
function getDeleteButton(id){
	return "<td><button class='deleteButton btn btn-block btn-secondary' data="+id+">Slett</button></td>";
}

/* Applies eventListener to a select, sends JSON data from server to 
'buildSpecificLogTable' function when the select changes */
function updateIndexTableFromSelect(){
	let select = document.getElementById('workoutSelect');
	let selected = select.options[select.selectedIndex];
	let id = selected.getAttribute('data');
	let request = new XMLHttpRequest();
	request.addEventListener("load",buildSpecificLogTable);
	request.open("POST","/workout/get_specific_workout");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
	request.send("id="+id);
};

/* Takes JSON data from server and builds a table with data */
function buildSpecificLogTable(){
	let tableBody = document.getElementById("logTableBody");

	/* Deletes old rows from table before inserting new ones */
	let deleteRows = tableBody.getElementsByClassName('generatedRow');
	for(let j=0;j<deleteRows.length;j++){
		deleteRows[j].remove();
	}
	let data = JSON.parse(this.response);
	let keys = Object.keys(data);
	/* Builds html table from server data as a string */
	for(let i=0;i<keys.length;i++){
		let tempObject = data[i];
		let id = tempObject[0];
		let kilo = tempObject[1];
		let reps = tempObject[2];
		let dato = tempObject[3];
		let string = "<tr class='generatedRow'><td>"+reps+"</td><td>"+kilo+"</td><td>"+dato+"</td>"+getDeleteButton(id)+"</tr>";
		tableBody.insertAdjacentHTML('beforeend',string);
	}
	enableDeleteButton('logId','deleteButton','delete_log');
}

/* Enables javascript for workout/add page */
function applyAddEventListener(){
	enableDeleteButton('workoutId','deleteButton','delete_workout');
	let formElement = document.getElementById('addWorkoutForm');

	/* Disables normal form event, and enables javascript request */
	formElement.addEventListener("submit",function(e){
		let input = document.getElementById('name');
		e.preventDefault();

		/* Sends request, inserts data from server in table as html */
		let request = new XMLHttpRequest();
		request.addEventListener("load",function(){
			removeErrorMessage();
			if(this.response != 0){
				let data = JSON.parse(this.response);
				let rowString = "<tr><td>"+data['name']+"</td>"+getDeleteButton(data['id'])+"</tr>";
				let tbody = document.querySelector('tbody');
				tbody.insertAdjacentHTML('beforeend',rowString);
				enableDeleteButton('workoutId','deleteButton','delete_workout');
			} else {
				insertErrorMessage("Øvelse ble ikke lagt til, prøv igjen eller kontakt nettside administrator");
			}
		});
		request.open("POST",'/workout/add_workout');
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
		request.send("name="+input.value);
	});
}
/* Enables javascript for workout/log page */
function applyLogEventListener(){

	let select = document.getElementById('workoutSelect');
	/* Adds event to update hidden input elements with the selected excercise */
	select.addEventListener("change",updateNameAndId);
	enableDeleteButton('logId','deleteButton','delete_log');

	/* Disables normal form event, and enables javascript request */
	let formElement = document.getElementById('addLogForm');
	formElement.addEventListener("submit",function(e){
		e.preventDefault();
		let formId = document.getElementById('workoutId').value;
		let formName = document.getElementById('workoutName').value;;
		let formReps = document.getElementById('reps').value;
		let formKilo = document.getElementById('kilo').value;

		/* Sends request, inserts data from server in table as html */
		let request = new XMLHttpRequest();
		request.addEventListener("load",function(){
			removeErrorMessage();
			if(this.response != 0){
				let data = JSON.parse(this.response);
				let rowString = "<tr>"
				+"<td>"+data['name']+"</td>"
				+"<td>"+data['reps']+"</td>"
				+"<td>"+data['kilo']+"</td>"
				+"<td>"+data['date']+"</td>"
				+getDeleteButton(data['id'])
				+"</tr>";
				let tbody = document.querySelector('tbody');
				tbody.insertAdjacentHTML('beforeend',rowString);
				enableDeleteButton('workoutId','deleteButton','delete_workout');
			} else {
				insertErrorMessage("Øvelse ble ikke loggført, prøv igjen eller kontakt nettside administrator");
			}
		});
		request.open("POST",'/workout/add_log');
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
		request.send("kilo="+formKilo+"&reps="+formReps+"&name="+formName+"&workoutId="+formId);
	});
}

/* Updates two inputs with data from chosen select element */
function updateNameAndId(){
	let select = document.getElementById('workoutSelect');
	let selected = select.options[select.selectedIndex];
	let id = selected.getAttribute('data');
	let idInput = document.getElementById('workoutId');
	let nameInput = document.getElementById('workoutName');
	idInput.value = id;
	nameInput.value = selected.innerText;
	nameInput.setAttribute('value',selected.innerText);
	idInput.setAttribute('value',id);
}

/* When the delete button is pressed, the data-id from the row is sent to the chosen URL.
And when the server deletes the data successfully, the row is removed from the table */
function enableDeleteButton(idType,divClass,url){
	let btns = document.getElementsByClassName(divClass);
	for(let i=0;i<btns.length;i++){
		btns[i].addEventListener("click",function(){
			var buttonDiv = this;
			let id = buttonDiv.getAttribute('data');
			let request = new XMLHttpRequest();
			request.addEventListener("load",function(){
				removeErrorMessage()
				let deleted = this.response;
				if(deleted == 1){
					let row = buttonDiv.parentElement.parentElement;
					row.remove();
				} else {
					insertErrorMessage("Data ble ikke slettet, prøv igjen eller kontakt nettside administrator");
				}
			});
			request.open("POST",url);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
			request.send(idType+'='+id);
		});
	}
}

/* Removes error message */
function removeErrorMessage(){
	let error = document.getElementById("errorMessageDiv");
	if(error){
		error.remove();
	}
}

/* Adds error message at the top of website if database fails */
function insertErrorMessage(msg){
	removeErrorMessage()
	let div = '<div id="errorMessageDiv" class="alert alert-danger" role="alert">'+msg+'</div>';
	document.body.insertAdjacentHTML('afterbegin',div);
}

function applyPasswordEventListener(){
	/* Disables normal form event, and enables javascript request */
	let formElement = document.getElementById('sendMailPasswordTokenForm');
	formElement.addEventListener("submit",function(e){
		let email = document.getElementById('email');
		e.preventDefault();

		/* Sends request, inserts data from server in table as html */
		let request = new XMLHttpRequest();
		request.addEventListener("load",function(){
			removeErrorMessage();
			if(this.response != 0){
				let msg = '<div id="errorMessageDiv" class="alert alert-success" role="alert">Sjekk epost for link</div>';
				document.body.insertAdjacentHTML('afterbegin',msg);
			} else {
				insertErrorMessage("Feil ved database, prøv igjen eller kontakt nettside administrator");
			}
		});
		request.open("POST",'/login/send_password_link');
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
		request.send("email="+email.value);
	});
}