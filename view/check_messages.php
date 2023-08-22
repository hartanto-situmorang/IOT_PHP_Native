<?php
// Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');

// Check for new messages
$statement = $pdo->query("SELECT * FROM messages ORDER BY timestamp DESC LIMIT 1");
$message = $statement->fetch(PDO::FETCH_ASSOC);

// Prepare the response
$response = array('message' => '');

if ($message) {
    $response['message'] = $message['content'];

    // Delete the message from the database
    $deleteStatement = $pdo->prepare("DELETE FROM messages WHERE id = :id");
    $deleteStatement->bindValue(':id', $message['id']);
    $deleteStatement->execute();
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
