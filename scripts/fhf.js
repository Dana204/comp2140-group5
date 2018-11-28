// Below Function Executes On Form Submit
//Author: Michael Goldson
function validate() {

// Storing Field Values In Variables															

	var name = document.getElementById("name").value;
	var depart = document.getElementById("department").value;
	var email = document.getElementById("email").value;
	var area = document.getElementById("area").value;
	var location = document.getElementById("location").value;
	var descrip = document.getElementById("description").value;
	var category = document.getElementById("category").value;

// Regular Expression For Email
	var emailreg = (/^[a-zA-Z]*\.[a-zA-Z0-9]+@(jm.nestle|tt.nestle|nestle)\.com$/);

// Conditions
	//None of the text fields are empty.
	if (name != '' && depart != '' && email != '' && area != '0' && location != '' && descrip != '' && category != '0') {
		if(email.match(emailreg)){							
			alert('Form submitted!');
			return true;
		}
		else{
			document.getElementById("name").className = "valid";
			document.getElementById("department").className = "valid";
			document.getElementById("email").className = "invalid";
			document.getElementById("area").className = "valid";
			document.getElementById("location").className = "valid";
			document.getElementById("description").className = "valid";
			document.getElementById("category").className = "valid";
			alert('Email Invalid');
			return false
		}
	}
	else{
		document.getElementById("name").className = "invalid";
		document.getElementById("department").className = "invalid";
		document.getElementById("email").className = "invalid";
		document.getElementById("area").className = "invalid";
		document.getElementById("location").className = "invalid";
		document.getElementById("description").className = "invalid";
		document.getElementById("category").className = "invalid";
		alert("All fields are required.....!");
		return false;
	}
}

/*
function isNotValid(Value){
	document.getElementById("courseCode").className = "valid";
	document.getElementById("courseTitle").className = "valid";
	document.getElementById("courseDiscipline").className = "valid";
	document.getElementById("level").className = "valid";
	document.getElementById("credit").className = "valid";
	document.getElementById("semester").className = "valid";
	document.getElementById("author").className = "valid";
	//alert(""+ Value);

	if (document.getElementById("courseCode").className = Value){
		document.getElementById("courseCode").className = "invalid";
		alert(""+ Value);
	}
	else if (document.getElementById("courseTitle").className = Value){
		document.getElementById("courseTitle").className = "invalid";
		alert(""+ Value);
	}
	else if (document.getElementById("courseDiscipline").className = Value){
		document.getElementById("courseDiscipline").className = "invalid";
		alert(""+ Value);
	}
	else if (document.getElementById("level").className = Value){
		document.getElementById("level").className = "invalid";
		alert(""+ Value);
	}
	else if (document.getElementById("credit").className =Value){
		document.getElementById("credit").className = "invalid";
		alert(""+ Value);
	}
	else if (document.getElementById("semester").className = Value){
		document.getElementById("semester").className = "invalid";
		alert(""+ Value);
	}
	else if (document.getElementById("author").className =Value){
		document.getElementById("author").className = "invalid";
		alert(""+ Value);
	}

}*/