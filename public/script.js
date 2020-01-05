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
function enableJavascriptForm(url,formId){
	let formElement = document.getElementById(formId);
	formElement.addEventListener("submit",function(e){
		e.preventDefault();
		let dataString = "";
		let formChildren = formElement.querySelectorAll('input');
		console.log(formChildren);
		for(let i=0;i<formChildren.length;i++){
			let tempInput = formChildren[i];
			let name = tempInput.getAttribute('name');
			if(name){
				let hiddenValue = tempInput.getAttribute('value');
				let value = tempInput.value;
				if(hiddenValue){
					value = hiddenValue;
				}
				dataString += name+'='+value+'&';
			}
		}
		let request = new XMLHttpRequest();
		request.addEventListener("load",function(){
			if(this.response != 0){
				let data = JSON.parse(this.response);
				let table = document.querySelector('table');
				table.insertAdjacentHTML('beforeend',data['element']);
				enableDeleteButton(data['idType'],data['divClass'],data['url']);
			}
		});
		request.open("POST",url);
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
		request.send(dataString);
	});
}
