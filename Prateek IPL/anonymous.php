<!DOCTYPE html>
<html>
<head>
	<title>Player Stats</title>
	<link rel="stylesheet" href="/css/anonymous.css">
</head>
<body>
	<h1>Player Stats</h1>
	<!-- Creating a table to show the player details -->
	<table>
		<tr>
			<th>Player Name</th>
			<th>Runs Scored</th>
			<th>Balls Faced</th>
            <th>Strike Rate</th>
		</tr>

		<?php
			// Connect to the database
			$servername = "localhost";
			$username = "Prateek";
			$password = "pass";
			$dbname = "IPLscore";
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			// Get the player stats from the database
			$sql = "SELECT * FROM players";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // Output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<tr><td>" . $row["player_name"] . "</td><td>" . $row["runs_scored"] . "</td><td>" . $row["balls_faced"] . "</td><td>" . round((($row["runs_scored"])/($row["balls_faced"]))*100,2) . "</td></tr>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();
		?>
	</table>

	<br><br>
	
	<!-- Creating a button which when clicked will show the man of the match based on highest strike rate -->
	<button onclick="showManOfTheMatch()">Man of the Match</button>

    <div id="manOfTheMatch"></div>

    <script>
        function showManOfTheMatch() {
            // Send an AJAX request to get the player with the highest strike rate
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("manOfTheMatch").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "manofmatch.php", true);
            xmlhttp.send();
        }
    </script>

	<br><br>

	<a href="index.php">Go to main page</a>

</body>
</html>
