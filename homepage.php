<?php

	// join the session
	session_start();

	// check if the window cookie is set, if it is gather the data, if not just set a random variable of 28 days
	if(isset($_COOKIE["window"])){

		$window = $_COOKIE["window"];

		if($window == "1week"){
			$url = "http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/infections?ts=7";
			$duration = 7;
		}elseif($window == "2weeks"){
			$url = "http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/infections?ts=14";
			$duration = 14;
		}elseif($window == "3weeks"){
			$url = "http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/infections?ts=21";
			$duration = 21;
		}elseif($window == "4weeks"){
			$url = "http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/infections?ts=28";
			$duration = 28;
		}
	}else{
		$duration = 28;
		$url = "http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/infections?ts=28";
	}

	// check distance cookie is set, if not just set a random distance of 0
	if(isset($_COOKIE["distance"])){
		$distance = $_COOKIE["distance"];
	}else{
		$distance = 0;
	}

	// start curl request to the API
	$curling = curl_init($url);

	// use the GET endpoint of the URL, setting the time span as the window cookie variable
	curl_setopt($curling,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl, CURLOPT_HTTPGET, true);

	// execute the curl request
	$result=curl_exec($curling);
	curl_close($curling);

	// get the username from the session variables
	$username = $_SESSION['username'];

	// connect to the database
	$conn = mysqli_connect("localhost","olivia","password","coviddb");

    if(!$conn){
        die("Connection error: " . mysqli_connect_error());
    }
    else{
	$xydata = [];

	// gather a list of all the users visit locations
        $sql = "SELECT * FROM visits WHERE username='$username'";
	$data = mysqli_query($conn, $sql);

        if(mysqli_num_rows($data) > 0){
		$xydata = $data;
	}
    }
	mysqli_close($conn);
?>

<!DOCTYPE html PUBLIC “-//W3C//DTD HTML 4.01//EN” https://www.w3.org/TR/html4/strict.dtd>
<html>
	<head>
		<title>
			COVID-CT: Home Page
		</title>
		<style>
			h1{background-color:rgb(173,185,202);
				font-family:arial;
				text-align:center;
				font-size:40;
				font-style:strong;
				padding: 20px;
				margin:0;}

			p#Status{font-family:arial;
				margin-left: 600px;
				font-size: 20}

			p{margin-left: 350px;
				margin-right: 500px}

			p#Bottom{margin-top: 250px}

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

            div.menu a#home{background-color:rgb(132,151,176);}

			div.menu a#logout{position: absolute;
				bottom:130px;
				left:105px;}

            div#pictures{position: absolute;
				z-index: -1;
				right: 60px;
				top: 180px;
				border: 3px solid black;}

			hr{border: 1px solid black;
				margin-left:350px;
				margin-right: 50px;}

        </style>
		<script>
		function readJSON(jsoninput, xydata)
		{
			// jsoninput is the result from the API request
			// xydata is the result from the SQL query of the user's visits

			// turn API data into an array from JSON
			var obj = JSON.parse(jsoninput);

			var acceptedvisits = [];
			var userwindow = <?php echo $duration ?>;

			// loop through each reported infection in the array
			for (i = 0; i < obj.length; i++) {

				//var objdate = obj[i]["date"];
				//objdate = new Date(objdate);
				//var todaysdate = new Date();
				//var difference = todaysdate.getTime() - objdate.getTime();
				//difference = difference/(1000 * 3600 * 24);

                // random variable, otherwise code would break --- TO DO
				var difference = 100;

				// compare the date of the infection with the users chosen window
				if(difference <= userwindow){

					// if it lies within the window lay down the black marker and add it to a list of infections within the threshold
					acceptedvisits.push(obj[i]);
					var img = document.createElement("img");
					img.src = "marker_black.jpeg";
					img.style.position = "relative";

					// translate image to correct x and y values
					img.style.transform = translateX(obj[i]["x"]);
					img.style.transform = translateY(obj[i]["y"]);
					var src = document.getElementById("pictures");
					src.appendChild(img);
				}

			}

			var emptyarray = [];
			var userdistance = <?php echo $distance ?>;

			// check user actually has any of their own visits
			if(xydata != emptyarray){

				// loop through each visit
				for (i = 0; i < xydata.length; i++) {

					// gather x and y variables
					var x1 = xydata[i]['x'];
					var y1 = xydata[i]['y'];

					// loop through all the reported infections within their time threshold
					for(j = 0; j < acceptedvisits.length; j++){
						var x2 = acceptedvisits[i]['x'];
						var y2 = acceptedvisits[i]['y'];

						// calculate euclidean distance between each reported infection and the user visit
						var a = (x1-x2);
						var b = (y1-y2);
						var euclidean = Math.sqrt((a*a)+(b*b));

						// compare distance to chosen threshold
						if(euclidean <= userdistance){

							// if it is within the distance, place a red marker to cover the previous black one
							var img = document.createElement("img");
							img.src = "marker_red.jpeg";
							img.style.position = "relative";
							img.style.transform = translateX(acceptedvisits[i]["x"]);
							img.style.transform = translateY(acceptedvisits[i]["y"]);
							var src = document.getElementById("pictures");
							src.appendChild(img);
						}
					}
				}
			}
		}

		</script>

	</head>

	<body>

    	<h1>COVID - 19 Contact Tracing</h1>

        <div class="menu">
          <a href="homepage.php" id="home">Home</a>
          <a href="overviewpage.php">Overview</a>
          <a href="addvisitpage.php">Add Visit</a>
          <a href="reportpage.php">Report</a>
          <a href="settingspage.php">Settings</a>
          <a href="logout.php" id="logout">Logout</a>
      </div>

	  <p id ="Status">Status</p>
	  <hr>
	  <p> Hi <?php echo $_SESSION['username'] ?>, you might have had a connection to an infected person at the location shown in red.</p>
	  <p id ="Bottom">Click on the marker to see details about the infection.</p>
	  <div id="pictures">
		  <img class="map" src="exeter.jpg" width = 400px>
		  <script>
		  		var val = "<?php echo $result ?>";
				var val2 = "<?php echo $xydata ?>";
		  		readJSON(val, val2);
		  </script>
  	  </div>


    </body>

</html>
