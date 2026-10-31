<?php
require_once __DIR__ . '/../core/init.php';

require_once ROOT_PATH . '/app/models/projectsModel.php';
require_once ROOT_PATH . '/app/models/creatifsModel.php';
require_once ROOT_PATH . '/app/controllers/projectsController.php';
require_once ROOT_PATH . '/app/models/tagsModel.php';

$action = $_GET['action'] ?? '';
$id = (int) ($_GET['id'] ?? 0);
$slug = $_GET['slug'] ?? '';

if ($action === 'editForm') {

    \App\Controllers\ProjectsController\editForm($connexion, $id, $slug);

} elseif ($action === 'update') {

    \App\Controllers\ProjectsController\update($connexion, $id, $slug);

} else {
    http_response_code(404);
    echo "Route introuvable.";
}