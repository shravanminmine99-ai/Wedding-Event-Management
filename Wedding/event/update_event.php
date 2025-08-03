<?php
include 'db_connect.php';

$id         = $_POST['event_id'] ?? '';
$client_id  = $_POST['client_id'] ?? '';
$event_name = $_POST['event_name'] ?? '';
$event_date = $_POST['event_date'] ?? '';
$start_time = $_POST['start_time'] ?? '';
$end_time   = $_POST['end_time'] ?? '';
$venue_id   = $_POST['venue_id'] ?? '';
$status     = $_POST['status'] ?? '';

$stmt = $conn->prepare("UPDATE events SET client_id=?, event_name=?, event_date=?, start_time=?, end_time=?, venue_id=?, status=? WHERE event_id=?");
$stmt->bind_param("sssssssi", $client_id, $event_name, $event_date, $start_time, $end_time, $venue_id, $status, $id);

if ($stmt->execute()) {
    echo "<script>alert('Event updated successfully.'); window.location.href='print_events.php';</script>";
} else {
    echo "<script>alert('Update failed.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
