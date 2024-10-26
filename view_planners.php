<?php
include 'db_connect.php';

// Fetch planners and events
$sql = "SELECT ep.planner_name, ep.planner_id, e.event_name, e.event_date, e.event_id 
        FROM event_planner ep LEFT JOIN events e ON ep.planner_id = e.planner_id";
$events = $pdo->query($sql)->fetchAll();

// Delete event
if (isset($_GET['delete_event_id'])) {
    $delete_event_id = $_GET['delete_event_id'];
    $pdo->query("DELETE FROM events WHERE event_id = $delete_event_id");
    header("Location: view_planners.php");
    exit;
}

// Delete planner
if (isset($_GET['delete_planner_id'])) {
    $delete_planner_id = $_GET['delete_planner_id'];
    $pdo->query("DELETE FROM event_planner WHERE planner_id = $delete_planner_id");
    header("Location: view_planners.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Planners and Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Event Planners and Events</h2>
    <table border="1">
        <tr>
            <th>Planner Name</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?= $event['planner_name'] ?></td>
            <td><?= $event['event_name'] ?></td>
            <td><?= $event['event_date'] ?></td>
            <td>
                <a href="update_event.php?event_id=<?= $event['event_id'] ?>">Update</a>
                <a href="view_planners.php?delete_event_id=<?= $event['event_id'] ?>">Delete Event</a>
                <a href="view_planners.php?delete_planner_id=<?= $event['planner_id'] ?>">Delete Planner</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add_planner.php">Add Planner</a>
    <a href="add_event.php">Add Event</a>
</body>
</html>
