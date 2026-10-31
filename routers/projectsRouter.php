<?php
require_once __DIR__ . '/../core/init.php';

require_once ROOT_PATH . '/app/models/projectsModel.php';
require_once ROOT_PATH . '/app/models/creatifsModel.php';
require_once ROOT_PATH . '/app/models/tagsModel.php';
require_once ROOT_PATH . '/app/controllers/projectsController.php';

$action = $_GET['action'] ?? 'index';

if ($action === 'show') {
    $id = (int) ($_GET['id'] ?? 0);
    $slug = $_GET['slug'] ?? '';

    \App\Controllers\ProjectsController\show($connexion, $id, $slug);

} else {

    \App\Controllers\ProjectsController\index($connexion);
}