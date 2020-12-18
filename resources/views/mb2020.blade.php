<html>
<head>
<title>Fill the form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>

	html, body {
		margin: 0px;
		padding: 0px;
		background: #FFF;
	}

	body {
		font-family: Arial, san-serif;
		font-size: 1.2em;
		color: #555;
	}


	input, textarea, select {
		font-size: 1em;
	}


	.container {
		background: #FFF;
		max-width: 700px;
		margin: 0px auto;
	}

	main {
		background: White;
		box-shadow: 0px 0px 5px 5px #DDD;
	}

	main div#heading {
		background: url(/images/header.jpg) no-repeat;
		background-size: cover;
		height: 200px;
		;
	}


	input.form-control, select.form-control, textarea.form-control {
		border: none;
		border-bottom: 1px solid #DDD;
		display: block;
		width: 100%;
		outline: none;
		line-height: 150%;
		padding: 10px;
	}

	form {
		padding: 25px 35px;
		min-height: 400px;
	}

	header {
		text-align:center;
		margin-bottom: 20px
	}

	header img {
		width: 500px;
		height: auto;
	}

	label {
		color: #888;
	}

	button.btn-submit {
		border-radius: 5px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-o-border-radius: 5px;
		background-color: #00aeaf;
		color: #FFF;
		border: none;
		padding: 10px 15px;
		font-size: 100%;
	}

	.center-align {
		text-align: center;
	}


	::-webkit-input-placeholder { /* Edge */
	  color: #BBB;
	}

	:-ms-input-placeholder { /* Internet Explorer 10-11 */
	  color: #BBB;
	}

	::placeholder {
	  color: #BBB;
	}


</style>
</head>
<body>

	<div class="container">
		<header>
			<a href="http://www.perfectweddingday.ca"><img src="/images/landing-logo.png" /></a>
		</header>

		<main>
			<div id="heading">


			</div>
			
			<form action="" id="leadForm" method="POST">

				<div class="form-group">
					<input type="text" name="name" value="" id="couple_name" class="form-control" required placeholder="Couple Name" />
				</div>

				<div class="form-group">
					<input type="email" name="email" value="" id="email" class="form-control" required placeholder="E-mail" />
				</div>

				<div class="form-row">
					<div class="col">
						<input type="text" name="wedding_date" value="" id="wedding_date" required class="form-control" placeholder="Wedding Date" />
					</div>
					<div class="col">
						<input type="text" name="phone" value="" id="phone" class="form-control" placeholder="Phone (Optional)" />
					</div>
				</div>

				<br/>

				<div class="form-group">
					<p>&nbsp; I am &nbsp; <label><input type="radio" name="type" value="Bride" checked /> Bride</label>  <label><input type="radio" name="type" value="Groom" /> Groom</label>  <label><input type="radio" name="type" value="Other" /> Other</label> </p>
				</div>

				<br/>

				<p class="center-align">
					<small>By clicking on 'Signup' I am accepting the legal terms of Perfect Wedding Day.</small>
				</p>



				<p>&nbsp;</p>

				<div class="form-goup center-align">
					<button type="submit" class="btn-submit">Signup</button>
				</div>

				<div class="form-group">
					<p>&nbsp;</p>
					<label>
						<input type="checkbox" name="subscribe" value="Yes" />
						Yes, I want Perfect Wedding Day to send promotional emails about Perfect Wedding Day and its vendor and advertising partners.
					</label>
				</div>

			</form>
		</main>

		<footer>


		</footer>


	</div>
<script type="text/javascript">

window.onload = function(e) { 
  
  	checkCookie();

  	var apikey = 'gUQn3aI2NYNfCO6ENxwTRZWRcbxl89TINkpppNCRoNAh5xtg3e';
  	var siteurl = 'https://leadgenpro.teamit.ca/';

	var VD = new FormData();

	  VD.append('js_id', accessCookie('userCookie') || '')
	  VD.append('referrer_page',document.referrer || '');
	  VD.append('referrer_domain',document.referrer.split('/')[2] || '');
	  VD.append('search_term','' || '');
	  VD.append('landing_page', window.location.pathname || '');
	  VD.append('ip','127.0.0.1');
	  VD.append('location', '');
	  VD.append('browser', navigator.appName || '');
	  VD.append('browser_version', navigator.appVersion || (navigator.userAgent || ''));
	  VD.append('latitude','');
	  VD.append('longitude', '');
	  VD.append('location_accuracy','');

  	var vst = createCORSRequest('POST',siteurl + 'api/regVisitor?key=' + apikey);

	vst.onload = function () {
	      var vresp = vst.responseText;

	      var sPath = window.location.pathname;

	      var PD = new FormData();
	      PD.append('js_id',accessCookie('userCookie'));
	      PD.append('page',sPath);
	      
	      var pgv = createCORSRequest('POST',siteurl + 'api/pageView?key=' + apikey);
	      pgv.onload = function () {
	        var pgvresp = vst.responseText;
	        console.log(pgvresp)
	      }

	      pgv.onerror = function() {
	        console.log('Error when registering pageview');
	      }

	      pgv.send(PD);

	};

  	vst.onerror = function () {
      	console.log('Error saving visitor!')
  	};

  	vst.send(VD);
  	initialize();
	
}



function initialize() {

	var apikey = 'gUQn3aI2NYNfCO6ENxwTRZWRcbxl89TINkpppNCRoNAh5xtg3e';
  	var siteurl = 'https://leadgenpro.teamit.ca/';
  
  	function sendData() {

  		var frm = createCORSRequest('POST',siteurl + 'api/submitform?key=' + apikey);
  		var FD = new FormData(form);

      	var sPath = window.location.pathname;

      	FD.append('js_id',accessCookie('userCookie'));
      	FD.append('page',sPath);

		frm.onload = function () {
	        var resp = frm.responseText;

	        console.log(resp);
      		document.getElementById("leadForm").innerHTML = resp;
	    };

	    frm.onerror = function () {
	        console.log('Error posting the form!')
	    };

	    frm.send(FD);
  	}
 
  	// Access the form element...
  	var form = document.getElementById("leadForm");

	// ...and take over its submit event.
	form.addEventListener("submit", function (event) {
	    event.preventDefault();
	    sendData();
	});

}

var ID = function () {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return '_' + Math.random().toString(36).substr(2,30);
};

function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}


function createCORSRequest(method, url) {
  var xhr = new XMLHttpRequest();
  if ("withCredentials" in xhr) {
    // XHR for Chrome/Firefox/Opera/Safari.
    xhr.open(method, url, true);
  } else if (typeof XDomainRequest != "undefined") {
    // XDomainRequest for IE.
    xhr = new XDomainRequest();
    xhr.open(method, url);
  } else {
    // CORS not supported.
    xhr = null;
  }
  return xhr;
}


function createCookie(cookieName,cookieValue,daysToExpire)
{
  var date = new Date();
  date.setTime(date.getTime()+(daysToExpire*24*60*60*1000));
  document.cookie = cookieName + "=" + cookieValue + "; expires=" + date.toGMTString()+';path=/;'
}
    
function accessCookie(cookieName)
{
  var name = cookieName + "=";
  var allCookieArray = document.cookie.split(';');
  for(var i=0; i<allCookieArray.length; i++)
  {
    var temp = allCookieArray[i].trim();
    if (temp.indexOf(name)==0)
    return temp.substring(name.length,temp.length);
  }
  return "";
}

function deleteCookie(cookieName)
{
  document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;';
  console.log('Cooki deleted!');
}


function checkCookie()
{
  var user = accessCookie("userCookie");

  if (user!=""){
     console.log('User is welcome back- ' + user);
  }
  else
  {
    createCookie("userCookie", makeid(30), 30);
    console.log('new user created' + accessCookie("userCookie"))
  }
}


</script>
</body>
</html>