function sendForm(){
	//form validation start
	document.getElementById('formErrors').innerHTML= "";
	var errors = [];
	var emailInForm =  document.getElementsByName("emailAddress")[0].value;
	var nameInForm =  document.getElementsByName("entry.1224778685")[0].value;
	var messageInForm =  document.getElementsByName("entry.512804397")[0].value;
	
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
		data.append("emailAddress", emailInForm);
		data.append("entry.1224778685", nameInForm);
		data.append("entry.512804397", messageInForm);

		var xhr = new XMLHttpRequest();
		xhr.withCredentials = true;

		xhr.addEventListener("readystatechange", function () {
		  if (this.readyState === 4) {
			console.log(this.responseText);
		  }
		});
		
		xhr.open("POST", "https://docs.google.com/forms/d/e/1FAIpQLSfzM7cvQazK0b2hlPt5zFFjMncvMA6Io904DstCGfH75J1uuw/formResponse");
		xhr.send(data);
	}
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}