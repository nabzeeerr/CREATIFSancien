<?php
require_once __DIR__ . '/../core/init.php';

require_once ROOT_PATH . '/app/models/projectsModel.php';
require_once ROOT_PATH . '/app/models/creatifsModel.php';
require_once ROOT_PATH . '/app/controllers/projectsController.php';
require_once ROOT_PATH . '/app/models/tagsModel.php';

$action = $_GET['action'] ?? '';

if ($action === 'addForm') {

    \App\Controllers\ProjectsController\addForm($connexion);

} elseif ($action === 'insert') {

    \App\Controllers\ProjectsController\insert($connexion);

} else {
    http_response_code(404);
    echo "Route introuvable.";
}