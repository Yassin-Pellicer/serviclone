<?php
header('Content-Type: application/json');

$eventModelPath = __DIR__ . '/../models/Event.php';
$vendorPath = __DIR__ . '/../vendor/autoload.php';

require_once $vendorPath;
require_once $eventModelPath;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/models/Event.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

try {
    $event = new Event();
    $method = $_SERVER['REQUEST_METHOD'];
    
    if ($method === 'GET') {
        if (isset($_GET['id'])) {
            $data = $event->getById($_GET['id']);
            if (!$data) {
                http_response_code(404);
                echo json_encode(['message' => 'Event not found']);
                exit;
            }
        } elseif (isset($_GET['upcoming']) && $_GET['upcoming'] === 'true') {
            $data = $event->getUpcoming();
        } else {
            $data = $event->getAll();
        }
        
        echo json_encode($data);
    } else {
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => $e->getMessage()]);
}