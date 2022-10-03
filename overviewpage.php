<?php

	// join the session
	session_start();

	// get the session username
	$username = $_SESSION['username'];

	// connect to database
	$conn = mysqli_connect("localhost","olivia","password","database");

	if(!$conn){
		die("Connection error: " . mysqli_connect_error());
	}
	else{
		// gather all the visits of the user
		$sql = "SELECT * FROM visits WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
	}

	mysqli_close($conn);

?>
<!DOCTYPE html PUBLIC “-//W3C//DTD HTML 4.01//EN” https://www.w3.org/TR/html4/strict.dtd>
<html>
	<head>
		<title>
			COVID-CT: Visits Overview
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
				background-color:rgb(173,185,202);
				margin-top: 0px;}

			div.menu a:hover{background-color:rgb(132,151,176);}

			div.menu a {padding: 15px 8px 6px 16px;
				text-decoration: none;
				font-size: 20;
				color: black;
				display: block;
				font-family:arial;
				text-align:center;}

            div.menu a#Overview{background-color:rgb(132,151,176);}

			div.menu a#logout{position: absolute;
				bottom:130px;
				left:105px;}

			table {margin-left: 350px;
				font-family: arial; f
				ont-size: 20;
				margin-top: 60px;}

			td:last-child{cursor: pointer;}

        </style>

		<script>
			// removes the record from the database
			function removeFromDatabase(){

				// get date and time from the row to use as identifiers to delete
				var date = document.getElementById("dateid").value;
				var time = document.getElementById("timeid").value;

				// create a new XMLHttpRequest
				var xhttp = new XMLHttpRequest();

				// open the connection
				xhttp.open("POST", "http://ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:55240/overview.php", true);

				// set the header
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				// check connection is ready
				xhttp.onreadystatechange = function(){
			    		if (xhttp.readyState == 4 && xhttp.status == 200){
					}
				}
				// send request
				xhttp.send("date=" + date + "&time=" + time + "&do_delete=1");
				location.reload();
				return false;
			}
		</script>

	</head>

	<body>

    	<h1>COVID - 19 Contact Tracing</h1>

        <div class="menu">
          <a href="homepage.php">Home</a>
          <a href="overviewpage.php" id="Overview">Overview</a>
          <a href="addvisitpage.php">Add Visit</a>
          <a href="reportpage.php">Report</a>
          <a href="settingspage.php">Settings</a>
          <a href="logout.php" id="logout">Logout</a>
      </div>

	  <table style="width:60%" id="table">
		  <tr>
		    <th>Date</th>
		    <th>Time</th>
		    <th>Duration</th>
			<th>X</th>
			<th>Y</th>
			<th></th>
		  </tr>
		  <?php while($row = mysqli_fetch_array($result)):; ?>
		<tr>
			<td><?php echo $row[1];?></td>
			<td><?php echo $row[2];?></td>
			<td><?php echo $row[3];?></td>
			<td><?php echo $row[4];?></td>
			<td><?php echo $row[5];?></td>
			<td><form method="post" onsubmit="return removeFromDatabase()">
				<input type=image name="submit" src="cross.png" width=25 height=25>
				<input type="hidden" value="<?php echo $row[1];?>" name="date" id="dateid"></form>
				<input type="hidden" value="<?php echo $row[2];?>" name="time" id = "timeid"></form>
			</td>
		</tr>
	<?php endwhile;?>
    </table>

    </body>

</html>
