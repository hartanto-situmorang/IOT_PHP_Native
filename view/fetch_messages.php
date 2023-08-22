<?php
require_once('database_connection.php');

$query = "SELECT * FROM messages ORDER BY timestamp DESC";
$result = $pdo->query($query);

if ($result) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="message" data-id="' . $row['id'] . '">' . $row['content'] . '</div>';
    }
}
?>
