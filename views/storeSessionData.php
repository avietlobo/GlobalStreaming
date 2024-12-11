<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['index'], $data['participantName'], $data['country'], $data['evangelist'])) {
    $_SESSION['editCandidateData'] = $data;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
