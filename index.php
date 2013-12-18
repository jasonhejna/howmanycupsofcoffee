<!DOCTYPE HTML>
<html>
<head>
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel='stylesheet' media='screen and (max-width: 450px)' href='mobile.css' />
<title>how many cups of coffee</title>
<meta name="description" content="Personal Coffee Tracker for tabulation and graphing.">
<meta name="keywords" content="Tracking, Coffee, Biometrics">
<meta name="author" content="Jason Hejna">
<meta charset="UTF-8">
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0" />
<link href='http://fonts.googleapis.com/css?family=Lobster|Oswald:400,700|Open+Sans:400,800' rel='stylesheet' type='text/css'>
<link rel="apple-touch-icon" href="/apple-touch-icon.png"/>
<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon.png"/>
</head>
<body>
<h1 class="title">howmanycupsofcoffee.com</h1>
<h2 class="sub-title">Personal Coffee tracker</h2>
<form class="justbrewed">
<input id="valid" type="password" placeholder="Enter Secret">
<input id="valider" type="password" placeholder="username">
<input id="validest" type="password" placeholder="password">
<input id="newcoffee" type="button" value="+1">
<input id="newcoffeesessionauth" type="button" value="+1">
</form>
<div id="errorcode"></div>
<script>

if(localStorage.coffeecupauthsession){
console.log(localStorage.coffeecupauthsession);
//disable enter secret
document.getElementById("valid").style.display = "none";
document.getElementById("newcoffeesessionauth").style.display = "inline";
addonefromsession();
}else{
	console.log('nothin on the if radar captain');
	//draw graphs
}

function addonefromsession(){
	//newcoffeesessionauth onclick
	document.getElementById('newcoffeesessionauth').onclick=function(){
		//do an xmlHTTPrequest
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "/middlelayer/sessionadd.php?sessionkey="+localStorage.coffeecupauthsession, true);
		xhr.onload = function (e) {
		  if (xhr.readyState === 4) {
		    if (xhr.status === 200) {
		      console.log(xhr.responseText);
		      //parse response text
		      if(xhr.responseText==="success"){
		      	document.getElementById('errorcode').innerHTML = "another one bites the dust";
		      	alert("another one bites the dusk");
		      }
		      else if(xhr.responseText==="failed"){
		      	document.getElementById('errorcode').innerHTML = "Session expired. Please Log in.";
		      	alert("Session expired. Please Log in.");
		      	document.getElementById("valid").style.display = "inline";
			document.getElementById("newcoffeesessionauth").style.display = "none";
		      }
		      else{
		      	alert('Unknown error. Try again.');
		      }
		    } else {
		      console.error(xhr.statusText);
		      document.getElementById('errorcode').innerHTML = "internet error: "+xhr.statusText;
		      alert("internet error: "+xhr.statusText);
		      //add to localstorage upload to new api later
		    }
		  }
		};
		xhr.onerror = function (e) {
		  console.error(xhr.statusText);
		  document.getElementById('errorcode').innerHTML = "internet error: "+xhr.statusText;
		  alert("internet error: "+xhr.statusText);
		  //add to localstorage upload to new api later
		};
		xhr.send(null);
	}
}



//document.getElementById("newcoffee").disabled = true;
// on delete characters event: set r to 0
var strlngth=document.getElementById('valid').value.length;
document.getElementById('valid').onkeypress=function(){
		//check for delete keypress
	if(strlngth>=document.getElementById('valid').value.length || document.getElementById('valid').value.length === 0){
		r=0;
	}
	strlngth=document.getElementById('valid').value.length;
}
var r=0;
var idc="<?php require_once('middlelayer/config.php'); echo $web_secret ?>";
document.getElementById('valid').onkeyup=function(){

	if(r===3 && document.getElementById('valid').value===idc){
		console.log("first evaluation complete");
		//show more texboxes
		//
		//OR, CREATE THE ELEMENTS!!!
		//
		document.getElementById('errorcode').innerHTML = '';
		document.getElementById('valider').style.display = 'inline';
		document.getElementById('validest').style.display = 'inline';
		document.getElementById('newcoffee').style.display = 'inline';
	}

	if(r>6 && r<13){
		document.getElementById('errorcode').innerHTML = "This input won't do anything for you. It allows me to log my current cup of coffee. Please check out some other parts of the site.";
		alert("This input won't do anything for you. It allows me to log my current cup of coffee. Please check out some other parts of the site.");
	}
	else if(r===0 && document.getElementById('valid').value != idc.substr(0,1) ){
		document.getElementById('errorcode').innerHTML = "This input won't do anything for you. It allows me to log my current cup of coffee. Please check out some other parts of the site.";
		alert("This input won't do anything for you. It allows me to log my current cup of coffee. Please check out some other parts of the site.");
		console.log('logol');
	}
	else if(r>=13 && r<16){
		document.getElementById('errorcode').innerHTML = "Sorry for the inconvienence. But this is for Admin use only. Please check out some other parts of the site.";
		alert("Sorry for the inconvienence. But this is for Admin use only. Please check out some other parts of the site.");
	}
	else if(r>=16 && r<20){
		document.getElementById('errorcode').innerHTML = "I don't do anything. I'm only for the admin.";
		alert("I don't do anything. I'm only for the admin.");
	}
	else if(r>=20){
		document.getElementById('errorcode').innerHTML = "Life is awesome. Go live it. Preferably somewhere else.";
		alert("Life is awesome. Go live it. Preferably somewhere else.");
	}
r++;
}
document.getElementById('newcoffee').onclick=function(){
	if(document.getElementById('valider').value && document.getElementById('validest').value){	
		//document.getElementById("newcoffee").disabled = true;

		var xhr = new XMLHttpRequest();
		xhr.open("GET", "/middlelayer/?vone="+document.getElementById('valider').value+"&vtwo="+document.getElementById('validest').value, true);
		xhr.onload = function (e) {
		  if (xhr.readyState === 4) {
		    if (xhr.status === 200) {
		      console.log(xhr.responseText);
		      var data = JSON.parse(xhr.responseText);
		      //parse response text
		      if(data.authkey==="plusone"){		      	
		      	document.getElementById('errorcode').innerHTML = "another one bites the dust";
		      	alert("another one bites the dusk");
		      	document.getElementById('valid').style.display = 'none';
		      	document.getElementById('valider').style.display = 'none';
		      	document.getElementById('validest').style.display = 'none';
		      	document.getElementById('newcoffee').style.display = 'none';
		      	document.getElementById('newcoffeesessionauth').style.display = 'inline';

		      	localStorage.coffeecupauthsession=data.sessionkey;
		      }
		      else{
		      	alert('Incorrect username or password. Try again.');
		      }
		      console.log(data.sessionkey);
		    } else {
		      console.error(xhr.statusText);
		      document.getElementById('errorcode').innerHTML = "internet error: "+xhr.statusText;
		      alert("internet error: "+xhr.statusText);
		      //add to localstorage upload to new api later
		    }
		  }
		};
		xhr.onerror = function (e) {
		  console.error(xhr.statusText);
		  document.getElementById('errorcode').innerHTML = "internet error: "+xhr.statusText;
		  alert("internet error: "+xhr.statusText);
		  //add to localstorage upload to new api later
		};
		xhr.send(null);
	}else{
		alert("You didn't enter a password yo.");
	}
}

</script>
</body>
</html>
