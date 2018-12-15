<?php

include_once 'config/Database.php';
$query = 'SELECT provozovatel_id,email FROM provozovatel WHERE email LIKE ? AND password LIKE ?';

$stmt = $conn->prepare($query);

$stmt->bindParam(1, "admin");
$stmt->bindParam(2, "RyosukeFC");

$stmt->execute();

if ($stmt->fetchColumn() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $provozovatel_id = $row['provozovatel_id'];

    return true;
} else {
    return false;
}
