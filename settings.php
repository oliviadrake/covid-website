<!DOCTYPE html PUBLIC “-//W3C//DTD HTML 4.01//EN” https://www.w3.org/TR/html4/strict.dtd>
<html>
	<head>
		<title>
			COVID-CT: Settings.
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

            div.menu a {padding: 15px 8px 6px 16px;
				text-decoration: none;
				font-size: 20;
				color: black;
				display: block;
				font-family:arial;
				text-align:center;}

			div.menu a:hover{background-color:rgb(132,151,176);}

			div.menu a#Settings{background-color:rgb(132,151,176);}

			div.menu a#logout{position: absolute;
				bottom:130px;
				left:105px}

            form#f1 {text-align: center;
				padding-top: 100px}

            form#f1 input[type=text]{text-align: center;
				width: 30%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background: transparent;
				font-family: "Times New Roman";}

            form#f1 input[type=submit]{display:inline;
				text-align: center;
				width: 8%;
				margin: 1px 0;
				border: 0.5px solid black;
				height: 4%;
				background-color: white;
				font-family: "Times New Roman";
				border-radius: 5px;}

            form#f1 input[type=reset]{display:inline;
				text-align: center;
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

			.selecter {width: 30%;
				margin-left: 335px;
				border: 0.5px solid black;
				height: 5%;
				background: transparent;
				font-family: "Times New Roman";}
        </style>

		<script>
		// check there are no blank entries and inform the user if there are
		function checkBlankEntry() {
			var windoww = document.forms["f1"]["window"].value;
			if (windoww == "") {
				alert("Window must be filled out");
				return false;
			}

			var distance = document.forms["f1"]["distance"].value;
			if (distance == "") {
				alert("Distance must be filled out");
				return false;
			}
			else if (parseInt(distance) > 500) {
				alert("Distance must be less than 500");
				return false;
			}
			else if (parseInt(distance) < 0) {
				alert("Distance must be more than 0");
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
          <a href="reportpage.php">Report</a>
          <a href="settingspage.php" id="Settings">Settings</a>
          <a href="logout.php" id="logout">Logout</a>
        </div>

          <p id ="title">Alert Settings</p>
          <hr>
          <p>Here you may change the alert distance and the time span for which the contact tracing will be performed</p>

		  <label for="windows">Window:</label>
          <select name="window" name="window" form="f1" class="selecter">
              <option value="1week">1 Week</option>
              <option value="2weeks">2 Weeks</option>
              <option value="3weeks">3 Weeks</option>
              <option value="4weeks">4 Weeks</option>
          </select>

          <form id="f1" onsubmit="return checkBlankEntry()" action="settings.php">
            <label for="distance">Distance:</label><br>
            <input type="text" name="distance" name="distance"><br><br>
            <input type="submit" id="report" value="Report">
            <input type="reset" id = "cancel" value="Cancel">
          </form>



    </body>

</html>
