<!-- PHP code to establish connection with the local server -->
<?php

// Database connection parameters
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'playersrecord';

// Create a new mysqli object
$mysqli = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($mysqli->connect_errno) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Retrieve input values from $_POST
$playerName = $_POST["playerName"];
$playerCountry = $_POST["playerCountry"];
$playerType = $_POST["playerType"];

// SQL query to select data from the database  //, runs, w.wickets, c.catches, m.matches
$sql = "SELECT *
        FROM players 
        LEFT JOIN runs  ON players.RunsID = runs.ID
        LEFT JOIN wickets  ON players.WicketsID = wickets.ID
        LEFT JOIN catches  ON players.CatchesID = catches.ID
        LEFT JOIN matches  ON players.MatchesID = matches.ID
        LEFT JOIN rankings ON players.RankingID=rankings.ID
        WHERE players.PlayerName = ? AND players.PlayerCountry = ? AND players.PlayerType = ?";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Check if the statement preparation was successful
if ($stmt) {
    // Bind the parameters with the values
    $stmt->bind_param("sss", $playerName, $playerCountry, $playerType);

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        ?>
        <!-- HTML code to display data in tabular format -->
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Player Details</title>
            <style>
             
                body {
                    background-image: url('./pictures/stadium.jpg');
                    background-size: cover;
                    background-position: center;
                }

                table {
                    width: 90%;
                    margin: 0 auto;
                    font-size: large;
                    border: 1px solid black;
                }
                h1 {
                    text-align: center;
                    color: white;
                    font-size: xx-large;
                    font-family: 'Gill Sans', 'Gill Sans MT', ' Calibri', 'Trebuchet MS', 'sans-serif';
                }
                th {
                    color: black;
                }
                td {
                    border: 1px solid black;
                }

                th,
                td {
                    color: bisque;
                    font-weight: bold;
                    border: 1px solid black;
                    padding: 10px;
                    text-align: center;
                }
                td {
                    font-weight: lighter;
                }
            </style>
        </head>
        <body>
            <h1>Player Details</h1>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Type</th>
                    <th>Runs-Odi</th>
                    <th>Runs-T20</th>
                    <th>Runs-Test</th>
                    <th>Odi-Matches</th>
                    <th>T20-Matches</th>
                    <th>Test-Matches</th>
                    <th>ODI-Wickets</th>
                    <th>T20-Wickets</th>
                    <th>Test-Wickets</th>
                    <th>Catches</th>
                    <th>Ranking-ODI</th>
                    <th>Ranking-T20</th>
                    <th>Ranking-Test</th>
                    
                </tr>
                <?php
                // Loop through each row in the result set
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['PlayerName']; ?></td>
                        <td><?php echo $row['PlayerCountry']; ?></td>
                        <td><?php echo $row['PlayerType']; ?></td>
                        <td><?php echo $row['Runs_In_ODI']; ?></td>
                        <td><?php echo $row['Runs_In_T20']; ?></td>
                        <td><?php echo $row['Runs_in_test']; ?></td>
                        <td><?php echo $row['MatchesOdi']; ?></td>
                        <td><?php echo $row['MatchesT20']; ?></td>
                        <td><?php echo $row['MatchesTest']; ?></td>
                        <td><?php echo $row['Wickets_In_ODI']; ?></td>
                        <td><?php echo $row['Wickets_In_T20']; ?></td>
                        <td><?php echo $row['Wickets_In_Test']; ?></td>
                        <td><?php echo $row['TotalCatches']; ?></td>
                        <td><?php echo $row['Ranking_ODI']; ?></td>
                        <td><?php echo $row['Ranking_T20']; ?></td>
                        <td><?php echo $row['Ranking_Test']; ?></td>
                        
                    </tr>
                    <?php
                }
                ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        // No matching records found
        echo "No records found.";
    }

    // Close the statement
    $stmt->close();
} else {
    // Statement preparation failed
    echo "Statement preparation failed: " . $mysqli->error;
}

// Close the database connection
$mysqli->close();
?>
