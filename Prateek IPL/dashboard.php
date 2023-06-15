<link rel="stylesheet" href="/css/dashboard.css">
<?php
/**

*User class handling player data.
*@category Class
*@package User
*@author [Prateek]
*/
require_once 'User.php';

$user = new User();

// Handle add player form submission
if (isset($_POST['add_player'])) {
    $player_name = $_POST['player_name'];
    $runs_scored = $_POST['runs_scored'];
    $balls_faced = $_POST['balls_faced'];

    $user->addPlayer($player_name, $runs_scored, $balls_faced);
}

// Handle delete player action
if (isset($_GET['delete_player'])) {
    $id = $_GET['delete_player'];

    $user->deletePlayer($id);
}

// Handle edit player form submission
if (isset($_POST['edit_player'])) {
    $id = $_POST['id'];
    $player_name = $_POST['player_name'];
    $runs_scored = $_POST['runs_scored'];
    $balls_faced = $_POST['balls_faced'];

    $user->editPlayer($id, $player_name, $runs_scored, $balls_faced);
}

// Get list of players from the database
$players = $user->getPlayers();
?>

<html>
    <head>
        <title>Cricket Dashboard</title>
    </head>
    <body>
        <h1>Cricket Dashboard</h1>
        <!-- Adding the new player -->
        <h2>Add Player</h2>
        <!-- Form created by method post -->
        <form method="post">
            <label for="player_name">Player Name:</label>
            <input type="text" name="player_name" required><br><br>

            <label for="runs_scored">Runs Scored:</label>
            <input type="number" name="runs_scored" required><br><br>

            <label for="balls_faced">Balls Faced:</label>
            <input type="number" name="balls_faced" required><br><br>

            <input type="submit" name="add_player" value="Add Player">
        </form>
        <a href="index.php">Logout</a>

        <hr>
        <!-- Displaying the player list and details -->
        <h2>Player List</h2>
        <table>
            <thead>
                <tr>
                    <th>Player Name</th>
                    <th>Runs Scored</th>
                    <th>Balls Faced</th>
                    <th>Strike Rate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Displaying the player details -->
                <?php foreach ($players as $player): ?>
                    <tr>
                        <td><?php echo $player['player_name']; ?></td>
                        <td><?php echo $player['runs_scored']; ?></td>
                        <td><?php echo $player['balls_faced']; ?></td>
                        <td><?php echo round(($player['runs_scored']/$player['balls_faced'])*100,2); ?></td>
                        <td>
                            <a href="?delete_player=<?php echo $player['id']; ?>">Delete</a> | 
                            <a href="#" onclick="editPlayer('<?php echo $player['id']; ?>', '<?php echo $player['player_name']; ?>', '<?php echo $player['runs_scored']; ?>', '<?php echo $player['balls_faced']; ?>')">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <hr>
        <!-- Edit player -->
        <h2>Edit Player</h2>
        <form method="post" id="edit_player_form" style="display:none">
            <input type="hidden" name="id" id="edit_player_id">
            <label for="player_name">Player Name:</label>
            <input type="text" name="player_name" id="edit_player_name" required>
            <br><br>
            <label for="runs_scored">Runs Scored:</label>
            <input type="number" name="runs_scored" id="edit_runs_scored" required><br><br>

            <label for="balls_faced">Balls Faced:</label>
            <input type="number" name="balls_faced" id="edit_balls_faced" required><br><br>

            <input type="submit" name="edit_player" value="Save">
            </form>
            
            <!-- Javascript to get the element by their id, name, runs and balls -->
            <script>
            function editPlayer(id, name, runs, balls) {
                document.getElementById('edit_player_id').value = id;
                document.getElementById('edit_player_name').value = name;
                document.getElementById('edit_runs_scored').value = runs;
                document.getElementById('edit_balls_faced').value = balls;
                document.getElementById('edit_player_form').style.display = 'block';
            }
            </script>
    </body>
</html>
