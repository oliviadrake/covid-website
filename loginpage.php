<!DOCTYPE html PUBLIC “-//W3C//DTD HTML 4.01//EN” https://www.w3.org/TR/html4/strict.dtd>
<html>
	<head>
		<title>
            COVID-CT: Login
		</title>
		<style>
			h1{background-color:rgb(173,185,202);
				font-family:arial;
				text-align:center;
				font-size:40;
				font-style:strong;
				padding: 20px;}

			body{background-image: url(watermark.png);
				background-size: 400px 400px;
				background-position: center;
				background-repeat: no-repeat;
				background-color: rgba(255,255,255,0.7);
				background-blend-mode: lighten;
				margin: 0;}

			::placeholder{color:black;}

			form#f1 {text-align: center;
				padding-top: 120px}

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

            form#f1 input[type=button]{text-align: center;
				width: 30%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				font-family: "Times New Roman";
				background-color: white;
				border-radius: 5px;}

            form#f1 input[type=submit]{display:inline;
				text-align: center;
				width: 15%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background-color: white;
				font-family: "Times New Roman";
				border-radius: 5px;}

            form#f1 input[type=reset]{display:inline;
				text-align: center;
				width: 15%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background-color: white;
				font-family: "Times New Roman";
				border-radius: 5px;}

			p {font-size: 20;
			color: red;}

        </style>
	</head>
	<body>
    	<h1>COVID - 19 Contact Tracing</h1>

        <form id="f1" method="POST" action="login.php">
		  <input type="text" name="username" placeholder="Username"><br>
		  <input type="password" name="password" placeholder="Password"><br><br><br>
          <input type="submit" value="Login">
          <input type="reset" value="Cancel"><br><br>
		  <input type="button" value="Register" onclick="location.href='registrationpage.php';">
		  <?php if(isset($errormessage)){ ?>
			  <p><?php echo $errormessage ?></p>
		  <?php } ?>
	  </form>
    </body>
</html>
