<?php
include 'db_connect.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $event = $pdo->query("SELECT * FROM events WHERE event_id = $event_id")->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_id = $_POST['event_id'];

    $sql = "UPDATE events SET event_name = :event_name, event_date = :event_date WHERE event_id = :event_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':event_name', $event_name);
    $stmt->bindParam(':event_date', $event_date);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->execute();

    echo "<p>Event updated successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Update Event</h2>
    <form method="POST">
        <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
        <label>Event Name:</label>
        <input type="text" name="event_name" value="<?= $event['event_name'] ?>" required>
        <label>Event Date:</label>
        <input type="date" name="event_date" value="<?= $event['event_date'] ?>" required>
        <button type="submit">Update Event</button>
    </form>
</body>
</html>
