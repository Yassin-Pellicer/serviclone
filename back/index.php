<?php
header('Content-Type: application/json');
?>
{
  "name": "Events API",
  "version": "1.0.0",
  "description": "API for accessing event data",
  "endpoints": {
    "events": {
      "getAll": "/api/events.php",
      "getById": "/api/events.php?id={id}",
      "getUpcoming": "/api/events.php?upcoming=true"
    },
    "tickets": {
      "getAll": "/api/tickets.php",
      "getByEventId": "/api/tickets.php?event_id={event_id}"
    },
    "sessions": {
      "getAll": "/api/sessions.php",
      "getById": "/api/sessions.php?id={id}"
      "getByEventId": "/api/sessions.php?event_id={event_id}"
    }
  }
}