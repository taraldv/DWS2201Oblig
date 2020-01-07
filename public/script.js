function getWorkoutSelectId(){
	let select = document.getElementById('workoutSelect');
	if(select){
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
