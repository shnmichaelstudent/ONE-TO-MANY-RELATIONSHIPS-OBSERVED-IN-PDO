<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $planner_name = $_POST['planner_name'];
    
    $sql = "INSERT INTO event_planner (planner_name) VALUES (:planner_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':planner_name', $planner_name);
    $stmt->execute();

    echo "<p>Event Planner added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Event Planner</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add Event Planner</h2>
    <form method="POST">
        <label>Planner Name:</label>
        <input type="text" name="planner_name" required>
        <button type="submit">Add Planner</button>
    </form>
    <a href="view_planners.php">View Event Planners and Events</a>
</body>
</html>
