<?php

/**
    *Class User
    *A class representing a user and their interactions with a database of IPL scores.
*/

class User {

    /*
        r mysqli The connection to the MySQL database.
    */

    private $conn;

    /**
        *User constructor.
        *Initializes the database connection.
    */

    public function __construct() {
        $servername = "localhost";
        $username = "Prateek";
        $password = "pass";
        $dbname = "IPLscore";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**

        *Attempts to log in the user by checking the username and password against the database.

        *@param string $username The user's username.

        *@param string $password The user's password.

        *@return bool Whether the login was successful or not.
    */

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**

        *Adds a new player to the database with the specified name, runs scored, and balls faced.

        *@param string $player_name The name of the player to add.

        *@param int $runs_scored The number of runs scored by the player.

        *@param int $balls_faced The number of balls faced by the player.

        *@return bool Whether the player was successfully added to the database or not.
    */

    public function addPlayer($player_name, $runs_scored, $balls_faced) {
        $sql = "INSERT INTO players (player_name, runs_scored, balls_faced) VALUES ('$player_name', $runs_scored, $balls_faced)";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    /**

        *Retrieves all players from the database and returns them as an array.

        *@return array An array of all players in the database.
    */

    public function getPlayers() {
        $sql = "SELECT * FROM players";
        $result = $this->conn->query($sql);

        $players = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($players, $row);
            }
        }

        return $players;
    }

    /**

        *Deletes the player with the specified ID from the database.

        *@param int $id The ID of the player to delete.

        *@return bool Whether the player was successfully deleted from the database or not.
    */

    public function deletePlayer($id) {
        $sql = "DELETE FROM players WHERE id = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    /**

        *Updates the player with the specified ID in the database with the new name, runs scored, and balls faced.
        
        *@param int $id The ID of the player to update.
        
        *@param string $player_name The new name for the player.
        
        *@param int $runs_scored Runs scored by the players
        
        *@param int $balls_faced Total balls faced by the player.
        
        *@return bool Whether the player is successfully updated in the database or not
    */

    public function editPlayer($id, $player_name, $runs_scored, $balls_faced) {
        $sql = "UPDATE players SET player_name = '$player_name', runs_scored = $runs_scored, balls_faced = $balls_faced WHERE id = $id";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Destructor that deallocates the user information or data.
     */

    public function __destruct() {
        $this->conn->close();
    }
}
?>
