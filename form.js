function sendForm(){
	//form validation start
	document.getElementById('formErrors').innerHTML= "";
	var errors = [];
	var emailInForm =  document.getElementsByName("postEmail")[0].value;
	var nameInForm =  document.getElementsByName("postName")[0].value;
	var messageInForm =  document.getElementsByName("postMessage")[0].value;
	
	if(emailInForm ==  ""){
		errors.push("Fill field Email");
	}
	else{
		if(!validateEmail(emailInForm)){
			errors.push("Please enter valid Email");
		}
	}
	
	if(nameInForm == ""){
		errors.push("Fill field Name");
	}
	if(messageInForm ==  ""){
		errors.push("Fill field Message");
	}

	if (errors.length > 0){
		errors.forEach(function(element) {
			console.log("Show error - " + element);
			let errorBlock = document.createElement("div");
			errorBlock.appendChild(document.createTextNode(element));
			document.getElementById('formErrors').appendChild(errorBlock);
		});	
	}
	else{
	//form validation end
		var data = new FormData();
		data.append("postEmail", emailInForm);
		data.append("postName", nameInForm);
		data.append("postMessage", messageInForm);

		var xhr = new XMLHttpRequest();
		xhr.withCredentials = true;

		xhr.addEventListener("readystatechange", function () {
		  if (this.readyState !== 4) {
			console.log("while wait for response result, block form");
			document.getElementsByName("submit")[0].disabled = true;
		  }
		  if (this.readyState === 4) {
			console.log(this.responseText);
			if (this.responseText == "Form received."){
				document.getElementsByTagName("form")[0].innerHTML = this.responseText;
			}
			else{
				document.getElementsByName("submit")[0].disabled = false;
				let errorBlock = document.createElement("div");
				errorBlock.appendChild(document.createTextNode(this.responseText));
				document.getElementById('formErrors').appendChild(errorBlock);
			}
		  }
		});
		
		xhr.open("POST", "form.php");
		xhr.send(data);
	}
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}