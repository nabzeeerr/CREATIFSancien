<?php
require_once __DIR__ . '/../core/init.php';

require_once ROOT_PATH . '/app/models/projectsModel.php';
require_once ROOT_PATH . '/app/controllers/projectsController.php';

$action = $_GET['action'] ?? '';
$id = (int) ($_GET['id'] ?? 0);
$slug = $_GET['slug'] ?? '';

if ($action === 'confirmDelete') {

    \App\Controllers\ProjectsController\confirmDelete($connexion, $id, $slug);

} elseif ($action === 'delete') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo "Méthode non autorisée.";
        exit;
    }

    \App\Controllers\ProjectsController\delete($connexion, $id, $slug);

} else {
    http_response_code(404);
    echo "Route introuvable.";
}