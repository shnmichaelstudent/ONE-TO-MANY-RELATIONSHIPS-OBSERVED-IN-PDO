<?php
include 'db_connect.php';

$planners = $pdo->query("SELECT * FROM event_planner")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $planner_id = $_POST['planner_id'];

    $sql = "INSERT INTO events (event_name, event_date, planner_id) VALUES (:event_name, :event_date, :planner_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':event_name', $event_name);
    $stmt->bindParam(':event_date', $event_date);
    $stmt->bindParam(':planner_id', $planner_id);
    $stmt->execute();

    echo "<p>Event added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add Event</h2>
    <form method="POST">
        <label>Event Name:</label>
        <input type="text" name="event_name" required>
        <label>Event Date:</label>
        <input type="date" name="event_date" required>
        <label>Event Planner:</label>
        <select name="planner_id" required>
            <?php foreach ($planners as $planner): ?>
                <option value="<?= $planner['planner_id'] ?>"><?= $planner['planner_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Add Event</button>
    </form>
    <a href="view_planners.php">View Event Planners and Events</a>
</body>
</html>
