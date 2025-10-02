<?php
require_once __DIR__ . '/../src/config.php';

if (isset($_GET['id'])) {
    $service->deletar($_GET['id']);
}
header("Location: index.php");
exit;
