<!DOCTYPE html PUBLIC “-//W3C//DTD HTML 4.01//EN” https://www.w3.org/TR/html4/strict.dtd>
<html>
	<head>
		<title>
			COVID-CT: Report Infection
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
				margin: 0;}

            div.menu {height:100%;
				width:300px;
				position:fixed;
				background-color:rgb(173,185,202);}

			div.menu a:hover{background-color:rgb(132,151,176);}

			div.menu a {padding: 15px 8px 6px 16px;
				text-decoration: none;
				font-size: 20;
				color: black;
				display: block;
				font-family:arial;
				text-align:center;}

            div.menu a#Report{background-color:rgb(132,151,176);}

			div.menu a#logout{position: absolute;
				bottom:130px
				;left:105px;}

			::placeholder{color:black;}

            form#f1 {text-align: center;
				padding-top: 80px}

            form#f1 input[type=date]{text-align: center;
				 width: 27%;
				 margin: 1px 0;
				 border: 0.5px solid black;
				 height: 4%;
				 background: transparent;
				 font-family: "Times New Roman";}

            form#f1 input[type=time]{text-align: center;
				width: 27%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background: transparent;
				font-family: "Times New Roman";}

            form#f1 input[type=submit]{display:inline;
				width: 8%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background-color: white;
				font-family: "Times New Roman";
				border-radius: 5px;}

            form#f1 input[type=reset]{display:inline;
				width: 8%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background-color: white;
				font-family: "Times New Roman";
				border-radius: 5px;
				margin-left: 250px;}

            hr{border: 1px solid black;
				margin-left:350px;
				margin-right: 50px;}

            p#title{font-family:arial;
				text-align:center;
				font-size: 20}

            p{margin-left: 350px;
				margin-right: 350px;
				text-align:center;}
        </style>
		<script>

		// check for any blank entries and notify the user if there is any
		function checkBlankEntry() {
			var date = document.forms["f1"]["date"].value;
			if (date == "") {
				alert("Date must be filled out");
				return false;
			}

			var time = document.forms["f1"]["time"].value;
			if (time == "") {
				alert("Time must be filled out");
				return false;
			}
		}

		</script>
	</head>
	<body>
    	<h1>COVID - 19 Contact Tracing</h1>

        <div class="menu">
          <a href="homepage.php">Home</a>
          <a href="overviewpage.php">Overview</a>
          <a href="addvisitpage.php">Add Visit</a>
          <a href="reportpage.php" id="Report">Report</a>
          <a href="settingspage.php">Settings</a>
          <a href="logout.php" id="logout">Logout</a>
       </div>

      <p id ="title">Report an Infection</p>
      <hr>
      <p>Please report the date and time when you tested positive for COVID - 19</p>

      <form id="f1" onsubmit="return checkBlankEntry()" action="report.php" method="post">
        <input type="date" name="date" placeholder="Date"><br><br>
        <input type="time" name="time" placeholder="Time" step="1"><br><br>
        <input type="submit" id="report" value="Report">
        <input type="reset" id = "cancel" value="Cancel">
      </form>

    </body>

</html>
