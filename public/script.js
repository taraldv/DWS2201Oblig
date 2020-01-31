function getWorkoutSelectData(){
	let select = document.getElementById('workoutSelect');
	let fun = function(){
		let selected = select.options[select.selectedIndex];
		let id = selected.getAttribute('data');
		let request = new XMLHttpRequest();
		request.addEventListener("load",buildSpecificLogTable);
		request.open("POST","/workout/get_specific_workout");
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
		request.send("id="+id);
	};
	select.addEventListener('change',fun);	
	fun();
}

function buildSpecificLogTable(){
	let table = document.getElementById("logTable");
	let deleteRows = table.getElementsByClassName('generatedRow');
	for(let j=0;j<deleteRows.length;j++){
		deleteRows[j].remove();
	}
	let data = JSON.parse(this.response);
	let keys = Object.keys(data);
	for(let i=0;i<keys.length;i++){
		let tempObject = data[i];
		let id = tempObject[0];
		let kilo = tempObject[1];
		let reps = tempObject[2];
		let dato = tempObject[3];
		let string = "<tr class='generatedRow'><td>"+reps+"</td><td>"+kilo+"</td><td>"+dato+"</td><td><button class='deleteButton btn btn-block btn-secondary' data="+id+">Slett</button></td></tr>";
		table.insertAdjacentHTML('beforeend',string);
	}
	enableDeleteButton('logId','deleteButton','delete_log');
}

function getWorkoutSelectId(){
	let select = document.getElementById('workoutSelect');
	select.addEventListener("change",function(){
		let selected = select.options[select.selectedIndex];
		let id = selected.getAttribute('data');
		let idInput = document.getElementById('workoutId');
		let nameInput = document.getElementById('workoutName');
		idInput.value = id;
		nameInput.value = selected.innerText;
		nameInput.setAttribute('value',selected.innerText);
		idInput.setAttribute('value',id);
	});
}
function enableDeleteButton(idType,divClass,url){
	let btns = document.getElementsByClassName(divClass);
	for(let i=0;i<btns.length;i++){
		btns[i].addEventListener("click",function(){
			var buttonDiv = this;
			let id = buttonDiv.getAttribute('data');
			let request = new XMLHttpRequest();
			request.addEventListener("load",function(){
				let deleted = this.response;
				if(deleted == 1){
					let row = buttonDiv.parentElement.parentElement;
					row.remove();
				}
			});
			request.open("POST",url);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
			request.send(idType+'='+id);
		});
	}
}
function appendTable(){
	if(this.response != 0){
		let data = JSON.parse(this.response);
		let table = document.querySelector('table');
		table.insertAdjacentHTML('beforeend',data['element']);
		enableDeleteButton(data['idType'],data['divClass'],data['url']);
	}

}
function appendParagraph(){
	if(this.response==1){
	document.body.insertAdjacentHTML('beforeend','<h1>Epost har blitt sendt, husk å sjekke spam</h1>');
	}
}
function enableJavascriptForm(url,formId,func){
	let formElement = document.getElementById(formId);
	formElement.addEventListener("submit",function(e){
		e.preventDefault();
		let dataString = "";
		let formChildren = formElement.querySelectorAll('input');
		for(let i=0;i<formChildren.length;i++){
			let tempInput = formChildren[i];
			let name = tempInput.getAttribute('name');
			if(name){
				let hiddenValue = tempInput.getAttribute('value');
				let value = tempInput.value;
				/*if(hiddenValue){
					value = hiddenValue;
				}*/
				dataString += name+'='+value+'&';
			}
		}
		let request = new XMLHttpRequest();
		request.addEventListener("load",func);
		request.open("POST",url);
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
		request.send(dataString);
	});
}
