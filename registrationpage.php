<!DOCTYPE html PUBLIC “-//W3C//DTD HTML 4.01//EN” https://www.w3.org/TR/html4/strict.dtd>
<html>
	<head>
		<title>
			COVID-CT: Registration
		</title>
		<style>
			h1{background-color:rgb(173,185,202);
				font-family:arial;
				text-align:center;
				font-size:40;
				font-style:strong;
				padding: 20px;
				margin:0;}

			body {background-image: url(watermark.png);
				background-size: 400px 400px;
				background-position: center;
				background-repeat: no-repeat;
				background-color: rgba(255,255,255,0.7);
				background-blend-mode: lighten;
				margin:0;}

			::placeholder{color:black;}

			form#f1 {text-align: center;
				padding-top: 140px}

			form#f1 input{text-align: center;
				width: 30%;
				border: 0.5px solid black;
				height: 4%;
				background-color: white;
				font-family: "Times New Roman";}

			form#f1 input[type=text]{text-align: center;
				width: 30%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background: transparent;
				font-family: "Times New Roman";}

			form#f1 input[type=password]{text-align: center;
				width: 30%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background: transparent;
				font-family: "Times New Roman";}

			form#f1 input[type=submit]{border-radius: 5px;}

		</style>

		<script>

		function checkBlankEntry() {
			var forename = document.forms["f1"]["forename"].value;
			if (forename == "") {
				alert("Forename must be filled out");
				return false;
			}

			var username = document.forms["f1"]["username"].value;
			if (username == "") {
				alert("Username must be filled out");
				return false;
			}

			var password = document.forms["f1"]["password"].value;
			if (password == "") {
				alert("Password must be filled out");
				return false;
			}
		}

		</script>
	</head>
	<body>

    	<h1>COVID - 19 Contact Tracing</h1>

		<form class="forms" name= "f1"id="f1"  method="POST" onsubmit="return checkBlankEntry()" action="registration.php">
		  <input type="text" name="forename" placeholder="Name" ><br>
		  <input type="text" name="surname" placeholder="Surname"><br>
		  <input type="text" name="username" placeholder="Username" ><br>
		  <input type="password" name="password" placeholder="Password" ><br><br><br>
			  <?php if(isset($passwordError)){ ?>
				  <p><?php echo $passwordError ?></p>
			  <?php } ?>
		  <input type="submit" value="Register">
		</form>

    </body>
</html>
