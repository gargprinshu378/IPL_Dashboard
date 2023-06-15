<?php
    /**
         * This script connects to a database and fetches the player with the highest strike rate.
         *
         * @param string $servername The name of the server where the database is hosted.
         * @param string $username The username used to connect to the database.
         * @param string $password The password used to connect to the database.
         * @param string $dbname The name of the database.
     */
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

    // Fetch the player with the highest strike rate
    $sql = "SELECT * FROM players ORDER BY runs_scored / balls_faced DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows >0){
        // Output the player with the highest strike rate
        if ($row = $result->fetch_assoc()) {
            echo "<p>Man of the Match: " . $row["player_name"] . " (Strike Rate: " . round(($row["runs_scored"] / $row["balls_faced"]) * 100, 2) . ")</p>";
        } else {
            echo "<p>No players found.</p>";
        }
    }
    // Close the connection
    $conn->close();
?>
    