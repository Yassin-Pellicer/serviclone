<?php
header('Content-Type: application/json');

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/models/Session.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

try {
  $session = new Session();
  $method = $_SERVER["REQUEST_METHOD"];

  if ($method == "GET") {
    if (isset($_GET['id'])) {
      $data = $session->getById($_GET['id']);
      if (!$data) {
        http_response_code(404);
        echo json_encode(['message' => 'Event not found']);
        exit;
      }
    }
    elseif (isset($_GET['event_id'])){
      $data = $session->getByEventId($_GET['event_id']);
    }
    else {
      $data = $session->getAll();
    }

    echo json_encode($data);
  } else {
    http_response_code(404);
    echo json_encode(['message' => 'Method not allowed']);
  }
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['message' => $e->getMessage()]);
}