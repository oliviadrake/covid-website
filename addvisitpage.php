<!DOCTYPE html PUBLIC “-//W3C//DTD HTML 4.01//EN” https://www.w3.org/TR/html4/strict.dtd>
<html>
	<head>
		<title>
			COVID-CT: Add Visit
		</title>
		<style>
			h1{background-color:rgb(173,185,202);
				font-family:arial;
				text-align:center;
				font-size:40;
				font-style:strong;
				padding: 20px;
				margin:0;}

			p#addvisit{font-family:arial;
				margin-left: 600px;
				font-size: 20}

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

            div.menu a#AddVisit{background-color:rgb(132,151,176);}

			div.menu a#logout{position: absolute;
				bottom:130px;left:105px;}

			::placeholder{color:black;}

			form#f1 {margin-left: 350px;}

			form#f1 input{text-align: center;
				width: 20%;
				border: 0.5px solid black;
				height: 4%;
				background: transparent;
				font-family: "Times New Roman";}

			form#f1 input[type=submit]{border-radius: 5px;
				background: white;
				position: absolute;
				bottom: 240;
				width: 14%;}

			form#f1 input[type=reset]{border-radius: 5px;
				background: white;
				position: absolute;
				bottom: 200;
				width: 14%;}

			hr{border: 1px solid black;
				margin-left:350px;
				margin-right: 50px;}

			div#mapdiv{position: absolute;right: 60px;
				top: 155px;
				border: 3px solid black;
				cursor: pointer;
				width: 400px;
				height:400px;}



        </style>

		<script>

		// checks for any blank entries and notifies the user
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

			var duration = document.forms["f1"]["duration"].value;
			if (duration == "") {
				alert("Duration must be filled out");
				return false;
			}

			var xcoord = document.forms["f1"]["xcoord"].value;
			if (xcoord == "") {
				alert("Coordinates must be filled out");
				return false;
			}

			var ycoord = document.forms["f1"]["ycoord"].value;
			if (ycoord == "") {
				alert("Coordinates must be filled out");
				return false;
			}
		}

		// will enter the chosen coordinates into the hidden inputs of the form
		function putCoordsIntoForm(x,y){
			document.getElementById("xcoord").value=x;
			document.getElementById("ycoord").value=y;
		}

		// gets coordinates from clicking the map
		function getCoords(event){
			// will get x and y coordinates of the mouse and offset them by how much the picture is offset
			var x = event.clientX;// - document.getElementById("mapdiv").offsetRight;
			var y = event.clientY;// - document.getElementById("mapdiv").offsetTop;

			putCoordsIntoForm(x,y);

			// will check if youve already placed a marker down and delete it so a new one can be added
			var element = document.getElementById("marker");
			if(typeof(element) != 'undefined' && element != null){
				element.remove();
			}

			// place down new marker image in the right coords
			var img = document.createElement("img");
			img.setAttribute("src","marker_black.png");
			img.setAttribute("id","marker");
			var src = document.getElementById("mapdiv");
			src.appendChild(img);

			var marker = document.getElementById("marker");
			marker.style.position = "relative";
			marker.style.transform = translateX(x);
			marker.style.transform = translateY(y);
			marker.style.width = 50px;
			marker.style.height = 50px;
		}


		</script>

	</head>

	<body>
    	<h1>COVID - 19 Contact Tracing</h1>


	<div id="mapdiv" onclick="getCoords(event)" style="background-image: url('exeter.jpg');background-size: 100% 100%;"></div>

        <div class="menu">
          <a href="homepage.php">Home</a>
          <a href="overviewpage.php">Overview</a>
          <a href="addvisit.php" id="AddVisit">Add Visit</a>
          <a href="reportpage.php">Report</a>
          <a href="settingspage.php">Settings</a>
          <a href="logout.php" id="logout">Logout</a>
      </div>

	  <p id ="addvisit">Add a new Visit</p>

	  <hr>

	  <form class="forms" id="f1" onsubmit="return checkBlankEntry()" action="addvisit.php" method="POST">
		<input type="date" id="date" name="date" placeholder="Date"><br><br>
		<input type="time" id="time" name="time" placeholder="Time" step="1"><br><br>
		<input type="text" id="duration" name="duration" placeholder="Duration"><br><br>
		<input type="text" id="xcoord" name="xcoord" placeholder="X Coordinate"><br><br>
		<input type="text" id="ycoord" name="ycoord" placeholder="Y Coordinate"><br>
		<input type="submit" id="add" value="Add"><br>
		<input type="reset" id ="cancel" value="Cancel">
	  </form>



    </body>
</html>
